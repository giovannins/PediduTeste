FROM php:8.3-bookworm

RUN apt-get update && apt-get install -y unzip libzip-dev sqlite3 libsqlite3-dev
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite zip
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    
WORKDIR /var/www/html
COPY . .

RUN composer install
RUN cp .env.example .env
RUN php artisan key:generate 
RUN php artisan migrate:fresh
RUN php artisan db:seed ItemSeeder

EXPOSE 8000

CMD ["php", "artisan", "serve"]