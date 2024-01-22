FROM php:8.2.3-apache-bullseye

# Remove the default site configuration
RUN rm /etc/apache2/sites-enabled/000-default.conf 

# Enable required Apache modules
RUN a2enmod expires headers rewrite ssl

# Update Apache configuration to allow .htaccess overrides
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends git zip unzip libpng-dev supervisor libsqlite3-dev libsqlite3-0 libzip-dev \
    && docker-php-ext-install zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip && docker-php-ext-install -j$(nproc) pdo_mysql gd zip mysqli \
    && rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["apache2-foreground"]