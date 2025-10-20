FROM php:8.2-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli

# Crear directorios necesarios
RUN mkdir -p /var/www/html/libraries/classes
RUN mkdir -p /var/www/html/vendor

# Copiar script de entrada
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Copiar archivos específicos primero
COPY libraries/ /var/www/html/libraries/
COPY vendor/ /var/www/html/vendor/

# Copiar el resto de archivos
COPY . /var/www/html/

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exponer el puerto de Apache
EXPOSE 80

# Usar el script de entrada personalizado
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
