FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli

# Copiar todos los archivos
COPY . /var/www/html/

# Crear directorios si no existen
RUN mkdir -p /var/www/html/libraries
RUN mkdir -p /var/www/html/vendor

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exponer el puerto de Apache
EXPOSE 80
