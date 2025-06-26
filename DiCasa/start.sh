#!/usr/bin/env bash

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

echo "Instalando dependências do Composer..."
composer install --no-dev --optimize-autoloader

echo "Gerando APP_KEY..."
php artisan key:generate

echo "Cache de config e rotas..."
php artisan config:cache
php artisan route:cache

echo "Rodando migrações SQLite..."
php artisan migrate --force

echo "Iniciando PHP-FPM e Nginx..."
php-fpm -D
nginx -g "daemon off;"
