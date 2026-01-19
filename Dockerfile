FROM php:8.3-fpm
RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev libfreetype6-dev libjpeg62-turbo-dev nginx supervisor && docker-php-ext-configure gd intl zip && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl && apt-get clean && rm -rf /var/lib/apt/lists/*
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install --optimize-autoloader --no-dev --no-scripts && php artisan key
