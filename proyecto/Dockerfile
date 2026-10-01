FROM php:8.2-apache

RUN docker-php-ext-install pdo_mysql

COPY app /var/www/html/app
COPY html /var/www/html
COPY vendor /var/www/html/vendor
COPY composer.json /var/www/html/composer.json
COPY composer.lock /var/www/html/composer.lock

EXPOSE 80