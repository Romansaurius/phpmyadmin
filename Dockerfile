FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli

# Copiar phpMyAdmin al servidor
COPY . /var/www/html/

# Exponer el puerto de Apache
EXPOSE 80
