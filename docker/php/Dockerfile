FROM    composer:1.8 as composer
FROM    php:7.3-fpm-alpine

COPY    --from=composer /usr/bin/composer /usr/local/bin/composer

# Removing APKINDEX warnings
RUN     rm -rf /var/cache/apk/* && \
        rm -rf /tmp/*
RUN     apk update

# Native libs and building dependencies
# su-exec > gosu (10kb instead of 1.8MB)
RUN     apk add --update --no-cache \
        git \
        unzip \
        make \
        nodejs \
        yarn \
        zlib-dev \
        libzip-dev \
        ca-certificates \
        php-intl \
        && apk add --no-cache --virtual .build-deps \
            $PHPIZE_DEPS \
            curl \
            icu-dev \
        && docker-php-ext-configure intl \
        && docker-php-ext-install \
            zip \
            intl \
            pdo_mysql \
        && yes | pecl install xdebug \
        && apk add --no-cache su-exec \
        && addgroup bar \
        && adduser -D -h /home -s /bin/sh -G bar foo \
        && apk del .build-deps

# PHP config
COPY    conf.d/php.ini /usr/local/etc/php
COPY    conf.d/symfony.ini /usr/local/etc/php/conf.d