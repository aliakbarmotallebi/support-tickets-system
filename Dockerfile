#FROM php:7.4-fpm
FROM php:8.1-fpm

# Quando entrar no container, esse vai ser pasta principal que ele vai entrar
WORKDIR /var/www
# Aqui vai remover a pasta html
RUN rm -rf /var/www/html
    
# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libfreetype6-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd  --enable-gd --with-freetype --with-jpeg \
    --enable-gd \
    --with-webp \
    && docker-php-ext-install -j$(nproc) gd

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets soap 

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setup our environment variables
ENV PHP_FILE_UPLOADS On
ENV PHP_ALLOW_URL_FOPEN On
ENV PHP_SHORT_OPEN_TAG On
ENV PHP_MEMORY_LIMIT 512M
ENV PHP_UPLOAD_MAX_FILESIZE 256M
ENV PHP_MAX_EXECUTION_TIME 5800

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# Copy existing application directory contents
COPY . .

# Copy existing application directory permissions
RUN chown -R www-data:www-data /var/www

# Change current user to www-data


ADD ./docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf

# USER www-data

# Liberar porta 9000 para iniciar o php-fpm server
EXPOSE 9000
