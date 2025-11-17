FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libpng-dev git \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite (importante para Laravel)
RUN a2enmod rewrite

# Copiar archivos
WORKDIR /var/www/html
COPY . .

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer puerto 8080
EXPOSE 8080

# Comando de inicio
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
