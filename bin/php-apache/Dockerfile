FROM php:7.4.30-apache-bullseye

# Remove the default site configuration
RUN rm /etc/apache2/sites-enabled/000-default.conf

# Enable required Apache modules
RUN a2enmod expires headers rewrite ssl

# Update Apache configuration to allow .htaccess overrides
RUN sed -e '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' -i /etc/apache2/apache2.conf

# Install dependencies
RUN apt-get update && apt-get install --no-install-recommends -y gnupg git zip unzip libpng-dev supervisor libsqlite3-dev libsqlite3-0 libzip-dev \
    && docker-php-ext-install zip \
    && pecl install xdebug-3.1.5  \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip && docker-php-ext-install -j$(nproc) pdo_mysql gd zip mysqli \
    && rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["apache2-foreground"]
