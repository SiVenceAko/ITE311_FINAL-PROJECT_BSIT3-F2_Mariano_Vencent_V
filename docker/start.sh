#!/bin/sh
set -e

cd /var/www/html

php artisan package:discover --ansi || true
php artisan storage:link || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run migrations if database is configured
if [ -n "$DB_CONNECTION" ]; then
  php artisan migrate --force || true
fi

exec /usr/bin/supervisord -c /etc/supervisord.conf
