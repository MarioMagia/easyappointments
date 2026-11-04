
#!/bin/sh
set -eu

echo "Starting Easy!Appointments..."

# Render supplies PORT automatically
PORT="${PORT:-10000}"

case "$PORT" in
    ''|*[!0-9]*)
        echo "Invalid PORT value"
        exit 1
        ;;
esac

# Configure Apache to use Render's port
sed -i "s/^Listen 80$/Listen ${PORT}/" \
    /etc/apache2/ports.conf

sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

# Generate Easy!Appointments configuration
php /usr/local/bin/write-config.php

# Ensure storage is writable
mkdir -p \
    /var/www/html/storage/backups \
    /var/www/html/storage/cache \
    /var/www/html/storage/logs \
    /var/www/html/storage/sessions \
    /var/www/html/storage/uploads

chown -R www-data:www-data /var/www/html/storage

chmod -R 775 /var/www/html/storage

echo "Easy!Appointments configuration completed."

exec apache2-foreground
