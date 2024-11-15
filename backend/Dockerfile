# Usar la imagen oficial de PHP con Apache
FROM php:8.0-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer (gestor de dependencias para PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el archivo composer.json y composer.lock antes de copiar el resto de los archivos
COPY ./backend/composer.json ./backend/composer.lock /var/www/html/

# Ejecutar Composer install (instalar dependencias)
RUN composer install --no-interaction --prefer-dist

# Copiar todos los archivos de Laravel al contenedor
COPY ./backend /var/www/html/

# Habilitar el módulo mod_rewrite de Apache
RUN a2enmod rewrite

# Exponer el puerto 8000
EXPOSE 8000

# Ejecutar el servidor de Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

