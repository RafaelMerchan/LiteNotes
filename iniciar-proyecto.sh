#!/bin/bash
echo "========================"
echo "Iniciando LiteNotes (Linux/macOS)"
echo "========================"

cd backend

if [ ! -f ".env" ]; then
    echo "Copiando .env.example como .env..."
    cp .env.example .env
fi

echo "Levantando contenedores con Docker..."
docker compose up -d --build

echo "Esperando 5 segundos para migraciones..."
sleep 5

echo "Corriendo migraciones..."
docker exec -it litenotes_app php artisan migrate

echo "========================"
echo "Proyecto listo en http://localhost:8000 y http://localhost:8080"
echo "========================"
