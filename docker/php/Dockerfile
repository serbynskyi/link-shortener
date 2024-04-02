FROM php:8.2.15-fpm

# install tools
RUN apt-get update && apt-get install -y --no-install-recommends apt-utils zip unzip

COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo_mysql

# install xdebug extension
RUN pecl install xdebug-3.2.1 \
	&& docker-php-ext-enable xdebug

ADD xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer &&\
    chmod +x /usr/local/bin/composer