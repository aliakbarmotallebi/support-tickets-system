FROM php:8.1-fpm-alpine

RUN apt-get update && apt-get upgrade -y && apt-get install -y libpq-dev zlib1g-dev libicu-dev nano

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

RUN composer dump-autoload --optimize

