FROM php:8.2-apache

RUN a2enmod headers

RUN printf '%s\n' \
    'Header always set X-Frame-Options "DENY"' \
    'ServerTokens Prod' \
    'ServerSignature Off' \
    > /etc/apache2/conf-available/security-headers.conf \
    && a2enconf security-headers

RUN printf '%s\n' \
    'expose_php = Off' \
    'session.cookie_httponly = 1' \
    'session.cookie_samesite = Lax' \
    > /usr/local/etc/php/conf.d/security.ini

RUN printf '%s\n' \
    'Header always unset X-Powered-By' \
    'Header always set X-Content-Type-Options "nosniff"' \
    'Header always set Permissions-Policy "camera=(), microphone=(), geolocation=()"' \
    'Header always set Cross-Origin-Opener-Policy "same-origin"' \
    'Header always set Cross-Origin-Resource-Policy "same-origin"' \
    'Header always set Cross-Origin-Embedder-Policy "require-corp"' \
    > /etc/apache2/conf-available/security-extra.conf \
    && a2enconf security-extra

RUN docker-php-ext-install pdo_mysql

COPY app /var/www/html/app
COPY html /var/www/html

EXPOSE 80