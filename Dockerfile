FROM php:8.2-fpm

# Installation des dépendances système et des extensions PHP (incluant PostgreSQL)
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie du code de l'application
WORKDIR /var/www
COPY . .

# Installation des dépendances Composer
RUN composer install --no-dev --optimize-autoloader

# Configuration des permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configuration Nginx
COPY .render/nginx.conf /etc/nginx/sites-available/default

EXPOSE 80

# Commande de démarrage
CMD php artisan migrate --force && php artisan storage:link && php artisan config:cache && php artisan route:cache && service nginx start && php-fpm