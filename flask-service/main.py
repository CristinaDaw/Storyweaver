import json
import os
import redis
import openai
from flask import Flask, request, jsonify
from langchain.chains import ConversationChain
from langchain.chains.llm import LLMChain
from langchain.memory import ConversationSummaryBufferMemory
from langchain_core.messages import AIMessage, HumanMessage
from langchain_core.prompts import PromptTemplate
from langchain_openai import ChatOpenAI
import logging
from flask_cors import CORS, cross_origin

app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": "*"}})
app.config['CORS_HEADERS'] = 'Content-Type'

logging.basicConfig(
    level=logging.DEBUG,  # Nivel de logging
    format='%(asctime)s - %(name)s - %(levelname)s - %(message)s',
    datefmt='%Y-%m-%d %H:%M:%S',
    handlers=[
        logging.FileHandler("app.log"),  # Guardar logs en un archivo
        logging.StreamHandler()  # Mostrar logs en la consola
    ]
)

logger = logging.getLogger(__name__)

# Conexión a Redis usando variables de entorno para los parámetros
redis_host = os.getenv('REDIS_HOST', 'localhost')
redis_port = int(os.getenv('REDIS_PORT', 6379))
redis_db = int(os.getenv('REDIS_DB', 0))
r = redis.Redis(host=redis_host, port=redis_port, db=redis_db)

# Diccionario en memoria para almacenar datos temporalmente (sustituto de Redis)
memory_store = {}


def message_to_dict(message):
    """Convierte un mensaje a un diccionario JSON serializable."""
    return {
        'type': type(message).__name__,
        'data': message.__dict__
    }


def dict_to_message(message_dict):
    """Convierte un diccionario a un mensaje."""
    message_type = message_dict['type']
    if message_type == 'HumanMessage':
        return HumanMessage(**message_dict['data'])
    elif message_type == 'AIMessage':
        return AIMessage(**message_dict['data'])
    else:
        raise ValueError(f"Unknown message type: {message_type}")


@app.route('/api/chat', methods=['POST'])
@cross_origin()
def chat():
    template = """You are a master of role-playing in the Dungeons & Dragons universe. Your mission is to guide the
    player through exciting adventures, creating worlds and plots of magic and danger. Based on a given context, 
    the player's character description in JSON format, a summary of a conversation between the player and yourself, and a
    player input, you must generate a coherent and cohesive response for the continuity of the plot.

    RULES:
    1. The response must be no more than 600 characters long.
    2. Always consider the starting context of the character and their characteristics to maintain cohesion and
    coherence throughout the adventure.
    3. Consider the previous conversation summary to keep the adventure's context and continue from that
    point coherently. Do not try to change randomly the situation, keep it organic.
    4. If the player's message is in Spanish, the response must also be in Spanish.
    5. The player's input will be preceded by a keyword such as 'Thought', 'Tell me more', 'Action', or 'Dialog'.
    You should provide a response coherent with the keyword:
    - If it's a Dialog type input: It means the player character is saying something.
    - If it's a Thought type input: It means the player character is thinking about something.
    - If it's a Tell me more type input: It means the player wants you to expand a bit more on the story or context.
    - If it's an Action type input: It means the player character wants to execute that action in the current context
    of the game.
    6. Try to keep the story interesting by introducing new characters, rivals, scenarios, etc., 
    without losing coherence or the normal development of the plot. Do so in a way that in the adventure 
    doesn't sound forced or excessively fast-paced but nor boring.
    7. Do not end the answer with a question or exclamation (e.g. Incorrect: You are in a dense forest, what would you 
    do next? | Correct: You are in a dense forest and is a rainy night, a raven crawls in the middle of the night.).

    Context: [context]
    Character: [character]
    Conversation Summary: [summary]
    History: {history}
    Player Input: {input}

    Master Answer:
    """

    data = request.get_json()

    game_id = data.get('game_id')
    message = data.get('message')
    context = data.get('context', "")
    summary = data.get('summary', "")
    character = data.get('character', "")

    logging.info('Context: ' + str(context))

    if context is not None and isinstance(context, str):
        template = template.replace('[context]', context)
    elif context is not isinstance(context, str):
        template = template.replace('[context]', str(context))
    else:
        # Manejar el caso en que context sea None, por ejemplo:
        template = template.replace('[context]', '')

    template = (template.replace('[character]', '{{{' + str(character) + '}}}')
                .replace('[summary]', str(summary)))

    prompt = PromptTemplate(template=template, input_variables=['input'])

    api_key = os.getenv('OPENAI_API_KEY')

    llm = ChatOpenAI(
        temperature=0.5,
        openai_api_key=api_key,
        model="gpt-3.5-turbo"
    )

    # Recuperar el estado de la memoria desde Redis
    memory_key = f"memory_{game_id}"
    summary_key = f"summary_{game_id}"
    memory_data = r.get(memory_key)
    if memory_data:
        memory_data = json.loads(memory_data)
        memory_data = [dict_to_message(m) for m in memory_data]
    else:
        memory_data = []

    previous_memory_summary = r.get(summary_key)

    if previous_memory_summary:
        previous_memory_summary = previous_memory_summary.decode('utf-8')
    else:
        previous_memory_summary = ""

    logging.info('Memory data: ' + str(memory_data))

    memory = ConversationSummaryBufferMemory(llm=llm, ai_prefix="AI: ", human_prefix="HUMAN: ")
    memory.chat_memory.add_messages(memory_data)
    logging.info('Prompt: ' + str(prompt))
    chat_chain = ConversationChain(
        llm=llm,
        prompt=prompt,
        memory=memory,
        verbose=True
    )

    response = chat_chain.invoke({'input': message})

    updated_memory_data = memory.chat_memory.messages
    updated_memory_data_serializable = [message_to_dict(m) for m in updated_memory_data]

    logging.info('Updated memory data: ' + str(updated_memory_data))

    updated_summary = memory.predict_new_summary(
        messages=updated_memory_data,
        existing_summary=previous_memory_summary
    )
    logging.info('Memory summary: ' + updated_summary)

    r.set(memory_key, json.dumps(updated_memory_data_serializable))
    r.set(summary_key, updated_summary)
    r.expire(memory_key, 86400)
    r.expire(summary_key, 86400)

    return jsonify(summary=updated_summary, response=str(response['response']))


@app.route('/api/image', methods=['POST'])
@cross_origin()
def generate_image():
    data = request.get_json()
    response_text = data.get('response_text', "")

    api_key = os.getenv('OPENAI_API_KEY')
    client = openai.Client(api_key=api_key)

    image_response = client.images.generate(
        model="dall-e-3",
        prompt="I NEED to test how the tool works with extremely simple prompts. "
               "DO NOT add any detail, just use it AS-IS:"
               "Generate a image for this situation in digital illustration style, "
               "the mood is Dungeons & Dragons. Avoid adding text in the image."
               "Situation: " + response_text,
        quality="standard",
        size="1024x1024",
        n=1
    )

    image_url = image_response.data[0].url

    if image_url:
        return jsonify(image_url=str(image_url))
    else:
        return jsonify(image_url='https://image-placeholder.com/images/actual-size/640x640.png')


@app.route('/api/first_shot_chat', methods=['POST'])
@cross_origin()
def first_shot_chat():
    if request.method == 'POST':
        try:
            data = request.get_json()
            character = data['character']

            context_template = """Eres un Master de rol en el universo de Dungeons & Dragons. Tu misión es crear un fragmento
                de texto con el inicio de aventura para el personaje del jugador. Recuerda crear un comienzo de aventura
                emocionante e interesante. Asegúrate de incluir detalles descriptivos del entorno, la apariencia del personaje
                y sus posesiones.

                REGLAS DE RESPUESTA:
                1. Provee una respuesta en un único párrafo sin 'bullet points' a modo de narración.
                2. Mantén un tono misterioso y elocuente propio de un master de rol, con cierto misticismo.
                3. Si el personaje tiene un background concreto puedes añadir pequeños detalles del mismo en la respuesta,
                sin excederte.
                4. La respuesta debe tener una longitud máxima de 1000 caracteres.
                5. Trata de hacer la historia genuina, única e interesante.

                Character: {character}
                Answer:

                EJEMPLOS:

                Ejemplo 1:
                    Character:
                        {{{{
                            "name": "Leowyl",
                            "class": "Druid",
                            "race": "Tiefling",
                            "faction": "Emmerald Enclave",
                            "background": "De pequeña sufrió viruela y tiene la cara marcada por las cicatrices."
                        }}}}

                    Answer: Leowyl, una tiefling druida del Emerald Enclave, emerge de los densos bosques de su hogar con una misión
                    urgente. La luz de la luna derrama su plata sobre su piel oscura, marcada con runas ancestrales, mientras se
                    abre paso entre los árboles centenarios. Viste una túnica de hojas trenzadas que ondea con la brisa nocturna,
                    y un cinturón de piel de lobo llena de frascos de cristal que tintinean con hierbas y pociones. La piel, tirante
                    en torno a las cicatrices de su rostro, recuerdo de una viruela en su infancia. A su alrededor,
                    el susurro de la vida nocturna del bosque y el destello de ojos curiosos en la oscuridad despiertan una
                    sensación de alerta en su espíritu druídico.

                Ejemplo 2:
                    Character:
                        {{{{
                            "name": "Theren",
                            "class": "Ranger",
                            "race": "Elf",
                            "faction": "Reign of Woods",
                            "background": "Le falta un ojo ya que un cuervo mágico se lo picoteó estando inconsciente tras una
                            batalla."
                        }}}}
                    Answer: Theren, un elfo arquero del Reino de los Bosques, avanza sigilosamente por la espesura del bosque
                    ancestral. Su larga capa verde oscuro se mezcla con la vegetación, apenas visible para los ojos no entrenados.
                     Una ligera lluvia cae sobre su rostro, rellenando la cuenca vacía de su ojo derecho como si de un llanto
                     desconsolado se tratara. La luna creciente hace brillar las hojas de su arco élfico y el brillo de sus afiladas
                     flechas de plata destaca en la densa negrura. Con cada paso, su mirada aguda escruta los alrededores,
                     en busca de cualquier amenaza que pueda acechar entre los árboles centenarios.
                """

            starting_llm = ChatOpenAI(
                temperature=0.5,
                openai_api_key=os.getenv("OPENAI_API_KEY"),
                model="gpt-3.5-turbo"
            )
            context_prompt = PromptTemplate(template=context_template, input_variables=['character'])
            chain = LLMChain(
                prompt=context_prompt,
                llm=starting_llm
            )
            context = chain.run(character=character)
            print(context)
            # Aquí devuelves la respuesta adecuada
            return jsonify(context=context)
        except Exception as e:
            # Maneja cualquier excepción y devuelve un mensaje de error
            return jsonify(error=str(e))
    else:
        # Maneja las solicitudes de otros métodos
        return 'Método no permitido'


if __name__ == '__main__':
    #Debug/Development
    app.run(debug=True, host="0.0.0.0", port=5000)
