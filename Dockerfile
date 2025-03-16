FROM php:8.3.19-fpm-bullseye

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libssl-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    procps \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP requeridas
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install xml \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install exif

# OpenSSL y Curl ya están incluidos en PHP en la imagen base
# No es necesario instalarlo como extensión separada

# Configuración PHP para mejorar los límites
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Configurar Nginx
COPY nginx.conf /etc/nginx/nginx.conf
COPY default.conf /etc/nginx/conf.d/default.conf

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY ./www /var/www/html

# Crear directorios requeridos
RUN mkdir -p /var/www/html/logs /var/www/html/fonts /var/www/html/images /var/log/nginx \
    && chown -R www-data:www-data /var/www/html/logs \
    && chmod -R 755 /var/www/html

# Eliminar la página de bienvenida predeterminada de Nginx
RUN rm -f /var/www/html/index.nginx-debian.html

# Exponer puertos estándar de Nginx
EXPOSE 80 443

# Configurar entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]
