<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
 /**
     * Descripciones de eventos hardcodeadas.
     *
     * @var array
     */
    private $descriptions = [
        ":name se ha encontrado cara a cara con el legendario dragón negro.",
        ":name ha descendido a las profundidades del Underdark, enfrentándose a horrores indescriptibles.",
        ":name ha descubierto la legendaria Ciudad Perdida de Cíbola, llena de tesoros y misterios antiguos.",
        ":name ha derrotado al temible Señor del Abismo en una batalla épica que resonará en los anales de la historia.",
        ":name ha forjado una alianza con la poderosa Reina de las Hadas, obteniendo su favor y protección.",
        ":name está en la búsqueda del infame Cazador de Dragones, jurando venganza por sus crímenes contra las criaturas místicas.",
        ":name ha rescatado al Príncipe Maldito de las garras de un hechizo oscuro, devolviéndole su forma humana.",
        ":name ha sido coronado como el nuevo Rey de los Enanos, recibiendo el apoyo y la lealtad de su pueblo.",
        ":name ha desenterrado el legendario Martillo de los Dioses, forjado en las llamas del Monte Celestial.",
        ":name ha explorado las oscuras calles de la Ciudad Subterránea de Menzoberranzan, enfrentándose a los peligros que acechan en las sombras.",
        ":name ha atravesado el Desierto de los Condenados, luchando contra la sed y los ataques de las criaturas del desierto.",
        ":name ha negociado con el poderoso Archimago para obtener el conocimiento necesario para derrotar a su enemigo.",
        ":name ha presenciado la caída de la Torre de la Magia Negra, poniendo fin al reinado del mal que se extendía desde sus sombras.",
        ":name se ha encontrado con el misterioso Oráculo de las Profundidades, recibiendo una profecía que cambiará el curso de su destino.",
        ":name ha liberado a los prisioneros de guerra de las garras de sus captores, ganando su gratitud y su apoyo en la batalla por la libertad.",
        ":name ha ascendido al Pico de la Montaña Prohibida, superando los peligros que acechan en su camino hacia la cima.",
        ":name ha desvelado el secreto oculto en el corazón del Valle de las Sombras, revelando la verdad que yacía enterrada durante siglos.",
        ":name ha defendido la Fortaleza del Sur de un ataque sorpresa, demostrando su valentía y su habilidad en la batalla.",
        ":name se ha encontrado con el Fantasma del Bosque Encantado, escuchando sus lamentos y ayudándolo a encontrar la paz.",
        ":name está en la caza del infame Ladrón de Almas, decidido a poner fin a su reinado de terror y devolver la esperanza a los corazones de los inocentes."
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtenemos todos los juegos
        $games = Game::all();

        // Iteramos sobre cada juego
        foreach ($games as $game) {
            // Obtenemos el personaje asociado al juego
            $character = $game->character;

            // Creamos evento de inicio de partida
            DB::table('events')->insert([
                'character_id' => $character->id,
                'description' => 'La aventura de ' . $character->name . ' comienza...',
                'created_at' => now()->subDays(30), // Crear una fecha mucho más antigua
                'updated_at' => now()->subDays(30) 
            ]);

            // Creamos  n eventos aleatorios intermedios entre 1 y 5
            $numEvents = rand(1, 5);
            for ($i = 1; $i <= $numEvents; $i++) {

                // Generamos una descripción única para este evento
                $randomDescription = '';

                do {
                    // Creamos un evento aleatorio sin validación
                    $randomDescription = str_replace(':name', $character->name, $this->descriptions[array_rand($this->descriptions)]);

                    // Validamos si ya existe una descripción idéntica para el personaje dado
                    $eventExists = DB::table('events')
                        ->where('character_id', $character->id)
                        ->where('description', $randomDescription)
                        ->exists();
                } while ($eventExists);

                // Insertamos el evento en la base de datos
                DB::table('events')->insert([
                    'character_id' => $character->id,
                    'description' => $randomDescription,
                    'created_at' => now()->subMinutes(rand(60, 1440) * $i), // Incrementamos los minutos por $i
                    'updated_at' => now()->subMinutes(rand(60, 1440) * $i), // Incrementamos los minutos por $i
                ]);     
            } 

            // Verificamos el estado del juego si es finished
            if ($game->status == 'Finished') {
                // Añadimos evento de partida finalizada
                DB::table('events')->insert([
                    'character_id' => $character->id,
                    'description' => 'La aventura de ' . $character->name . ' ha llegado a su fin.',
                    'created_at' => now(), // Se agrega al final
                    'updated_at' => now(),
                ]);
            }   
               
        }
    }
}
