#!/bin/bash

dockerize -wait tcp://db:3306 -timeout 20s
composer install
php artisan package:discover --ansi
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate --ansi
php artisan migrate
php-fpm
