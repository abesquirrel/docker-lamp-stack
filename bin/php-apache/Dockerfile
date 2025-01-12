FROM php:8.2.3-apache-bullseye

# Remove default site configuration and enable necessary Apache modules
RUN rm /etc/apache2/sites-enabled/000-default.conf && \
    a2enmod expires headers rewrite ssl

# Update Apache configuration to allow .htaccess overrides and set ServerName
RUN sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        libpng-dev \
        supervisor \
        libsqlite3-dev \
        libsqlite3-0 \
        libzip-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) pdo_mysql gd zip mysqli \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Comment out the line that loads Xdebug in the docker-php-ext-xdebug.ini file
RUN sed -i 's/^zend_extension=/;zend_extension=/g' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Copy Xdebug configuration for PHPStorm

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD ["apache2-foreground"]
