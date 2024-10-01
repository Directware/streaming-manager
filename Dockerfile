# Basis-Image
FROM arm64v8/php:7.4.9-apache-buster

WORKDIR /var/www/html

# Notwendige PHP-Module installieren
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libicu-dev \
    zlib1g-dev \
    libxml2-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql zip intl \
    && docker-php-ext-enable intl

# Ausgabe-Pufferung aktivieren
RUN echo "output_buffering = On" >> /usr/local/etc/php/conf.d/docker-php.ini
