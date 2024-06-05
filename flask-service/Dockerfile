## project-root/flask_service/Dockerfile
FROM python:3.11-slim

ENV PYTHONUNBUFFERED True

ENV APP_HOME /app
WORKDIR $APP_HOME
ENV FLASK_APP main.py

COPY requirements.txt requirements.txt

RUN apt-get update && apt-get install -y curl && \
    pip install --upgrade pip && \
    pip install --no-cache-dir -r requirements.txt

COPY . $APP_HOME

EXPOSE 5000

CMD ["flask", "run", "--host", "0.0.0.0"]
