FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    zip unzip libzip-dev libpng-dev git \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Configurar DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

# Copiar proyecto
WORKDIR /var/www/html
COPY . .

# Copiar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear enlace de storage
RUN php artisan storage:link || true

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponer puerto
EXPOSE 8080

# Entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

CMD ["/entrypoint.sh"]
