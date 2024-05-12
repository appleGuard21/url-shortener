ARG PHP_VERSION=8.2.13
ARG FPM_ALPINE_VERSION=3.18

FROM php:${PHP_VERSION}-fpm-alpine${FPM_ALPINE_VERSION}

ENV COMPOSER_ALLOW_SUPERUSER=1

ENV DEPENDENCIES \
    redis \
    autoconf \
    g++ \
    make \
    supervisor \
    libpq-dev \
    linux-headers

RUN set -xe \
    && apk update \
    && apk add --no-cache ${DEPENDENCIES} \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install -j$(nproc) sockets

COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/supervisor/url-shortener.conf /etc/supervisor/conf.d/url-shortener.conf

WORKDIR /var/www/url-shortener

COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer
COPY composer.json composer.lock ./
RUN composer install -o

COPY . .

RUN composer dump-autoload

RUN rm -rf /var/www/url-shortener/data/cache/config-cache.php \
    && chmod 777 -R /var/www/url-shortener/data

CMD ["php-fpm"]
EXPOSE 9000
