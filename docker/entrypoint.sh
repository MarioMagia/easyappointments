#!/bin/sh
set -eu

echo "Starting Easy!Appointments..."

PORT="${PORT:-10000}"

# Configure Apache port
sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf

sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

# Generate application configuration
php /usr/local/bin/write-config.php

# Prepare storage
mkdir -p /var/www/html/storage

chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage

echo "Starting Apache..."

exec apache2-foreground
