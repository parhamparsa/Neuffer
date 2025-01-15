FROM php:8.2-fpm

#RUN apt-get update && apt-get install -y \
#    curl \
#    libonig-dev \
#    libxml2-dev \
#    zip \
#    unzip \
#    libzip-dev \
#    git \
#    ext-gd \
#    ext-zip \
#    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath opcache
RUN apt-get update && apt-get install -y \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql mbstring exif pcntl bcmath opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./docker/php/php.ini $PHP_INI_DIR/conf.d/php.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY ../application .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

CMD ["php-fpm"]
