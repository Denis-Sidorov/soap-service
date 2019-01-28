FROM php:7.2-fpm-alpine

ARG INSTALL_XDEBUG=false

RUN apk add --update vim bash \
    build-base autoconf libtool pcre-dev && \

    #####################################
    # soap:
    #####################################
    apk add --update libxml2-dev && \
    docker-php-ext-install soap && \

    #####################################
    # xDebug:
    #####################################
    if [ ${INSTALL_XDEBUG} = true ]; then \
        pecl install xdebug && \
        docker-php-ext-enable xdebug \
    ;fi && \

    #####################################
    # Zip:
    #####################################
    apk add --update zlib-dev zlib && \
    docker-php-ext-install zip && \

    #####################################
    # etc:
    #####################################
    docker-php-ext-enable opcache && \

    #####################################
    # clean up:
    #####################################

    apk del --purge *-dev build-base autoconf libtool && \
    rm -rf /usr/include/php7 /usr/lib/php7/build /usr/lib/php7/modules/*.a

#####################################
# composer:
#####################################
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY php-error-dev.ini /usr/local/etc/php/conf.d/php-error.ini
COPY php-datetime.ini /usr/local/etc/php/conf.d/php-datetime.ini
COPY php-resources.ini /usr/local/etc/php/conf.d/php-resources.ini
COPY php-etc.ini /usr/local/etc/php/conf.d/php-etc.ini

RUN touch /var/log/php_error.log && \
    chown www-data:www-data /var/log/php_error.log

WORKDIR /var/www/app
