#!/bin/sh

echo "== Ejecutando migraciones =="
php artisan migrate --force || true

echo "== Iniciando servidor Apache =="
apache2-foreground
