FROM php:8.2-fpm    

# System Dependencies + PHP Extensions für Laravel/Filament
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \          # ← ZIP FIX!
    libicu-dev \          # ← INTL FIX!
    zip \
    unzip \
    nginx \
    supervisor

# PHP Extensions installieren (inkl. intl + zip)
RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \             # ← ZIP!
        intl              # ← INTL!

# Cleanup
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . /var/www/html

# Composer install (no-dev für Production)
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Laravel Optimizations
RUN php artisan key:generate --force \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Configs kopieren
COPY ./docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./docker/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
