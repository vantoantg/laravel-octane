# PHP 8.4 CLI (chạy Octane/Swoole) + Composer + Extensions cần thiết
FROM php:8.4-cli-alpine

# System deps
RUN apk add --no-cache \
    $PHPIZE_DEPS \
    curl git unzip bash icu-dev oniguruma-dev libzip-dev \
    libpng-dev freetype-dev libjpeg-turbo-dev \
    linux-headers openssl-dev \
    inotify-tools

# PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql intl pcntl bcmath zip

# Redis extension (phpredis)
RUN pecl install redis \
 && docker-php-ext-enable redis

# Swoole cho Octane (không kèm async-redis để tránh xung đột phpredis)
# (Bật các flags thường dùng: sockets, http2 nếu cần)
RUN pecl install swoole \
 && docker-php-ext-enable swoole

# Opcache (tăng tốc)
RUN docker-php-ext-install opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Tối ưu composer cho môi trường dev container
ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1

# Node (nếu bạn muốn build FE trong container)
# RUN apk add --no-cache nodejs npm

# Healthcheck đơn giản (artisan tinker nhanh)
HEALTHCHECK --interval=30s --timeout=5s --retries=5 CMD php -v || exit 1
