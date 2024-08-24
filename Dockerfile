FROM php:8.3.9-fpm

RUN apt-get update && apt-get install git -y

COPY --from=composer:latest /usr/bin/composer /urr/bin/composer

WORKDIR /var/www

EXPOSE 9000