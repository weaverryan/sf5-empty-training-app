FROM php:7.4-fpm-alpine

RUN apk --update --no-cache add git
RUN apk --update --no-cache add icu-libs
RUN apk --update --no-cache add icu-dev

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install bash, it's more familiar
RUN apk --update --no-cache add bash

# Install Node
RUN apk --update --no-cache add nodejs npm
RUN apk --update --no-cache add yarn

WORKDIR /var/www
CMD ["php-fpm"]
EXPOSE 9000
