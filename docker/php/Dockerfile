FROM php:7.4.11-fpm-alpine

ENV COMPOSER_HOME=/var/www/html/.composer

RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.15 --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install mysqli pdo pdo_mysql bcmath \
    && apk --no-cache add git
