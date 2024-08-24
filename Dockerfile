FROM php:8.3.9-fpm

RUN apt-get update && apt-get install git -y

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000