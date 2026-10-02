FROM php:8.2-apache

RUN docker-php-ext-install pdo_mysql

COPY app /var/www/html/app
COPY html /var/www/html

EXPOSE 80