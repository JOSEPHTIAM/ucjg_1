FROM php:8.2-cli

# Installation des dépendances et de l'extension pdo_pgsql pour PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copie des fichiers du projet
COPY . .

# Installation des dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 10000

# Commande de démarrage avec le serveur intégré de Laravel
CMD php artisan migrate --force && php artisan storage:link && php artisan config:cache && php artisan route:cache && php artisan serve --host 0.0.0.0 --port $PORT