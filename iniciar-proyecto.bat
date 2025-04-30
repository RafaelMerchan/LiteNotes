@echo off
echo ========================
echo Iniciando LiteNotes (Windows)
echo ========================

cd backend

IF NOT EXIST ".env" (
    echo Copiando .env.example como .env...
    copy .env.example .env
)

echo Levantando contenedores con Docker...
docker compose up -d --build

echo Esperando 5 segundos para migraciones...
timeout /t 5

echo Corriendo migraciones...
docker exec -it litenotes_app php artisan migrate

echo ========================
echo Proyecto listo en http://localhost:8000 y http://localhost:8080
echo ========================
