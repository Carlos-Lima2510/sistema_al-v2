FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    oniguruma-dev \
    autoconf \
    gcc \
    g++ \
    make \
    icu-dev \
    jpeg-dev \
    freetype-dev \
    nodejs \
    npm

RUN docker-php-ext-install \
    pdo_mysql \
    zip \
    mbstring \
    exif \
    pcntl \
    bcmath \
    intl \
    opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install && \
    chown -R www-data:www-data /var/www && \
    chmod 777 -R storage/ && \
    chmod 777 -R vendor/

EXPOSE 9000

CMD ["php-fpm"]