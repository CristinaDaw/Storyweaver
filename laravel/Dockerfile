# imagen oficial de PHP con Apache
FROM php:8.1-apache

WORKDIR /var/www/html

# Instalación de extensiones y dependencias necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    curl \
    nano \
    git

RUN docker-php-ext-install pdo pdo_mysql gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . ./app

COPY .env.example .env

# Activa el modulo de sobreescritura Apache
RUN a2enmod rewrite

#Copiar el conf del VirtualHost
COPY laravel.conf /etc/apache2/sites-available/laravel.conf

#Habilitar Virtualhost
RUN a2ensite laravel.conf

#deshabilitar el sitio por defecto de apache
RUN a2dissite 000-default.conf

# Dar permisos al directorio de almacenamiento y caché
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer puerto 8000
EXPOSE 8000

CMD ["apache2-foreground"]
