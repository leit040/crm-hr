FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
        unzip \
        wget \
        git \
        iproute2 \
        libzip-dev \
        libmagickwand-dev \
        libxslt-dev \
            --no-install-recommends


RUN docker-php-ext-install -j$(nproc) zip
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) xsl
RUN mkdir -p /usr/src/php/ext/imagick; \
    curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
    docker-php-ext-install imagick;

RUN pecl install -o -f xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

COPY install-composer.sh /
COPY php.ini /usr/local/etc/php/
COPY www.conf /usr/local/etc/php/
COPY entrypoint.sh /usr/local/bin/docker-php-entrypoint

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh /install-composer.sh \
    && rm /install-composer.sh

RUN usermod -u 1000 www-data

VOLUME /root/.composer
WORKDIR /app

EXPOSE 9000
CMD ["php-fpm"]
