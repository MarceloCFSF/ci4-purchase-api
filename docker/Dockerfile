FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libicu-dev zip unzip git \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install intl gd mysqli pdo pdo_mysql

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /user/bin/composer

COPY . .

COPY docker/php.ini /usr/local/etc/php/php.ini

RUN chown -R www-data:www-data /var/www/html/writable

CMD [ "php-fpm" ]
