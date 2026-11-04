FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    nodejs \
    npm \
    libcurl4-openssl-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype-dev \
    libxml2-dev \
    libonig-dev \
    libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure and install PHP extensions
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    curl \
    gd \
    mbstring \
    mysqli \
    xml

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Enable Apache modules
RUN a2enmod rewrite headers

WORKDIR /var/www/html

# Copy Easy!Appointments source
COPY . .

# Build frontend assets
RUN npm install \
    && npm run build

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Configure Apache overrides
RUN printf '%s\n' \
    '<Directory /var/www/html>' \
    '    Options FollowSymLinks' \
    '    AllowOverride All' \
    '    Require all granted' \
    '</Directory>' \
    > /etc/apache2/conf-available/easyappointments.conf \
    && a2enconf easyappointments

# Copy startup files
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/write-config.php /usr/local/bin/write-config.php

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && mkdir -p storage \
    && chown -R www-data:www-data storage

EXPOSE 10000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]