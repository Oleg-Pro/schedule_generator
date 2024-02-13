FROM php:8.3-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && pecl install apcu \
    && apt-get install -y libpq-dev  \
   && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


WORKDIR /var/www/schedule_generator

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN git config --global user.email "opp20071980@.com" \
    && git config --global user.name "Oleg Proshin"