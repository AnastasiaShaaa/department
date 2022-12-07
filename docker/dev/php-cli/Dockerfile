FROM php:8.1-cli-alpine

ENV PHP_IMAGICK_VERSION 3.6.0
#ENV PHP_XDEBUG_VERSION 3.1.2

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV PHPIZE_DEPS \
    autoconf cmake file g++ gcc libc-dev pcre-dev make git \
    pkgconf re2c oniguruma-dev freetype-dev libwebp-dev  \
    libpng-dev libjpeg-turbo-dev libxslt-dev

RUN apk add --no-cache --virtual .persistent-deps \
    icu-dev postgresql-dev libxml2-dev freetype \
    libpng libjpeg-turbo zip bzip2-dev libzip-dev libintl \
    libffi-dev gettext-dev libxslt

RUN apk add --no-cache --virtual .imagick-build-dependencies imagemagick-dev libtool librsvg ttf-dejavu \
    && apk add --virtual .imagick-runtime-dependencies imagemagick

RUN set -xe \
    && ln -s /usr/lib /usr/local/lib64 \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure intl --enable-intl \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure pdo_pgsql --with-pdo-pgsql \
    && docker-php-ext-configure mbstring --enable-mbstring \
    && docker-php-ext-configure soap --enable-soap \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) \
        gd bcmath intl pcntl pdo_pgsql \
        calendar exif gettext \
        shmop sockets sysvmsg \
        sysvsem sysvshm xsl ffi opcache \
    && git clone -o ${PHP_IMAGICK_VERSION} --depth 1 https://github.com/mkoppanen/imagick.git /tmp/imagick \
        && cd /tmp/imagick \
        && phpize  \
        && ./configure  \
        && make  \
        && make install \
        && echo 'extension=imagick.so' > /usr/local/etc/php/conf.d/imagick.ini \
    && apk del .build-deps \
    && apk del .imagick-build-dependencies \
    && rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet \
    && chmod +x /bin/composer

ARG SYMFONY_CLI_VERSION

RUN wget https://github.com/symfony/cli/releases/download/v$SYMFONY_CLI_VERSION/symfony_linux_amd64.gz \
    && gzip -d symfony_linux_amd64.gz \
    && mv symfony_linux_amd64 symfony \
    && chmod +x symfony \
    && mv symfony /usr/local/bin/

ARG GID
ARG UID
ARG GROUP_NAME
ARG USER_NAME

RUN addgroup -g $GID $GROUP_NAME && \
    adduser -u $UID -G $GROUP_NAME -h /home/$USER_NAME -D $USER_NAME

USER $USER_NAME

WORKDIR /app