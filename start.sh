#!/bin/bash

# Instalar dependencias de Composer y NPM
composer install --no-interaction --prefer-dist --optimize-autoloader
npm install
npm run build

# Ejecutar migraciones y enlaces simbólicos
php artisan migrate --force
php artisan storage:link

# Cachear configuración, rutas y vistas
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar el servidor
php artisan serve --host=0.0.0.0 --port=8080
