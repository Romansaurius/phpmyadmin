#!/bin/bash
set -e

# Verificar que los archivos necesarios existen
if [ ! -f "/var/www/html/libraries/constants.php" ]; then
    echo "Error: constants.php no encontrado"
    exit 1
fi

if [ ! -f "/var/www/html/vendor/autoload.php" ]; then
    echo "Error: autoload.php no encontrado"
    exit 1
fi

# Establecer permisos correctos
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

# Iniciar Apache
exec apache2-foreground