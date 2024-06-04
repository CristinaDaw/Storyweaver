# project-root/flask_service/Dockerfile
FROM python:3.11-slim

ENV PYTHONUNBUFFERED True

# Copy local code to the container images.
ENV APP_HOME /app
WORKDIR $APP_HOME

COPY requirements.txt requirements.txt

RUN apt-get update && apt-get install -y curl

RUN apt-get update && apt-get install -y curl && \
    pip install --upgrade pip && \
    pip install --no-cache-dir -r requirements.txt

COPY . ./

EXPOSE 5000

CMD ["python", "main.py"]




