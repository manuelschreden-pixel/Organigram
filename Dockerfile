FROM php:8.2-fpm

# System-Abhängigkeiten
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    curl

# PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip mbstring

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Projekt kopieren
COPY . .

# Abhängigkeiten installieren
RUN composer install --no-dev --optimize-autoloader

# Rechte
RUN chmod -R 775 storage bootstrap/cache

# Laravel Optimierung
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

# Startbefehl
CMD php artisan serve --host=0.0.0.0 --port=10000
