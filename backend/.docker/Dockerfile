FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libicu-dev \
    libpq-dev \
    librabbitmq-dev \
    libonig-dev \
    curl \
    && docker-php-ext-install \
        intl \
        opcache \
        pdo_pgsql \
        pdo_mysql \
        zip \
        gd \
        bcmath

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && composer --version

# Copy
COPY .docker/php/php.ini /usr/local/etc/php/


# Catalog
WORKDIR /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html

RUN groupadd -g 1000 devuser \
    && useradd -u 1000 -g devuser -m devuser

USER devuser

CMD ["php-fpm"]

