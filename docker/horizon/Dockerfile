FROM php:8.4-fpm-alpine

ARG UID=1000
ARG GID=1000

WORKDIR /var/www/html

RUN apk add --no-cache --update linux-headers icu-dev bash \
    && docker-php-ext-install pdo pdo_mysql bcmath intl pcntl

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -fsSL https://pecl.php.net/get/redis | tar xvz -C "/usr/src/php/ext/redis" --strip 1 \
    && docker-php-ext-install redis

RUN addgroup -g ${GID} --system laravel \
    && adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

USER laravel

CMD ["php", "artisan", "horizon"]
