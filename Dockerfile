FROM php:8.3-fpm

# Basis-Pakete (keine configure-Probleme)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nginx supervisor libzip-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev && \
    docker-php-ext-install -j$(nproc) pdo_mysql mbstring exif pcntl bcmath gd zip intl && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --
