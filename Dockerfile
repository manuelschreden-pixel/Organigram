FROM php:8.2-fpm

# System Dependencies – JEDER Backslash mit LEERZEICHEN davor!
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    nginx \
    supervisor

# PHP Extensions – SIMPEL & funktioniert immer
RUN docker-php-ext-configure gd \
 && docker-php-ext-configure intl \
 &&
