#!/bin/bash
set -e

PORT="${PORT:-80}"

# Render injects PORT at runtime, so the listen address is set here rather
# than baked into the image.
sed -ri "s/^Listen 80\$/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

# Writable runtime directories (Render containers start from a clean image).
mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs

# Build caches at boot: the environment variables Render provides are not
# available during the image build. route:cache is skipped because the home
# route in routes/web.php uses a closure, which cannot be serialized.
php artisan config:cache
php artisan view:cache

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
