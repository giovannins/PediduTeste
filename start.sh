#! /bin/bash
echo "Configurando projeto..."

composer install
cp .env.example .env
php artisan key:generate 
php artisan migrate:fresh
php artisan db:seed ItemSeeder
clear
sleep 1 # Drama....
echo "PROJETO CONFIGURADO!"
