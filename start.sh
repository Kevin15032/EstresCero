#!/bin/bash

# Comandos para producción
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

# Servir la app
php -S 0.0.0.0:${PORT:-8000} -t public
