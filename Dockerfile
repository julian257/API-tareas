FROM php:8.2-apache

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libpng-dev git \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Copiar archivos
WORKDIR /var/www/html
COPY . .

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Dar permisos a Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar entrypoint
COPY entrypoint.sh /entrypoint.sh

# Exponer puerto 8080
EXPOSE 8080

# Ejecutar migraciones y Apache
ENTRYPOINT ["/entrypoint.sh"]
