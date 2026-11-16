# syntax=docker/dockerfile:1

# ---------------------------------------------------------------------------
# Stage 1: build the Vite/Tailwind assets. public/build is git-ignored, so it
# has to be produced inside the image.
# ---------------------------------------------------------------------------
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json .npmrc ./
RUN npm ci

COPY vite.config.js ./
COPY resources ./resources
COPY public ./public

RUN npm run build

# ---------------------------------------------------------------------------
# Stage 2: PHP application served by Apache.
# ---------------------------------------------------------------------------
FROM php:8.3-apache

# pdo_pgsql/pgsql for Render Postgres, intl for locale-aware formatting,
# opcache for production performance.
RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev libicu-dev unzip \
    && docker-php-ext-install -j"$(nproc)" pdo_pgsql pgsql intl opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Rewrite rules for Laravel's front controller.
RUN a2enmod rewrite headers

COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf

# Render captures stdout/stderr, not files, so send request logs there.
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

WORKDIR /var/www/html

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Dependencies first so code changes do not invalidate the vendor layer.
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-autoloader --no-scripts --prefer-dist

COPY . .

# Built frontend assets from stage 1 (overrides anything copied above).
COPY --from=assets /app/public/build ./public/build

RUN composer dump-autoload --optimize --no-dev

COPY docker/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    PORT=80

# Render routes traffic to $PORT; the entrypoint rewrites Apache to match.
EXPOSE 80

ENTRYPOINT ["entrypoint"]
CMD ["apache2-foreground"]
