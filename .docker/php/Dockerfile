FROM php:8.2-fpm-alpine3.20

RUN apk add icu-dev vim
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl

WORKDIR /app
CMD ["php-fpm"]
