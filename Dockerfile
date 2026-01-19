FROM php:8.2-fpm  

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .
RUN composer install --optimize-autoloader --no-dev
RUN php artisan key:generate --force
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 . /var/www/storage /var/www/bootstrap/cache

# Optional: Migrations im Build (nur wenn DB schon da)
# RUN php artisan migrate --force --no-interaction

COPY ./docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY ./docker/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80
CMD php artisan config:cache && php artisan route:cache && php artisan view:cache && /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
