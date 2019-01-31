FROM php:latest

RUN apt-get update \
&& apt-get install openssl libssl-dev \
&& docker-php-ext-install pdo_mysql

VOLUME /var/local/sdlc
WORKDIR /var/local/sdlc
COPY . /var/local/sdlc

CMD php artisan migrate
