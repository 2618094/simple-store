FROM php:7.4.2-fpm-buster as base

RUN apt-get update && apt-get install -y \
    git \
    zip \
    libgmp-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install \
    mysqli \
    pdo_mysql \
    gmp

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin \
    --version=2.0.8


# LOCAL ONLY BLOCK
# set path
# https://bugs.xdebug.org/view.php?id=1584
# https://github.com/yiisoft/yii2-docker/blob/master/php/image-files/usr/local/bin/docker-php-entrypoint
RUN pecl install xdebug-beta
COPY docker-php-entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

RUN echo "alias a='php artisan'" >> /root/.bashrc
RUN echo "alias p='phpunit'" >> /root/.bashrc
RUN echo "alias pf='p --filter'" >> /root/.bashrc
#END LOCAL ONLY BLOCK

ENV PATH="${PATH}:/var/www:/var/www/vendor/bin"

EXPOSE 9000

WORKDIR /var/www
