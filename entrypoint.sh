#!/bin/bash
set -e

# Asegurar que todos los directorios existan y tengan los permisos correctos
mkdir -p /var/www/html/logs /var/www/html/fonts /var/www/html/images
chown -R www-data:www-data /var/www/html/logs
chmod -R 755 /var/www/html

# Eliminar la página de bienvenida predeterminada de Nginx si existe
rm -f /var/www/html/index.nginx-debian.html
rm -f /usr/share/nginx/html/index.html

# Iniciar PHP-FPM en segundo plano
php-fpm -D

# Iniciar Nginx en segundo plano
nginx -g "daemon off;" &

# Iniciar OpenLiteSpeed en segundo plano
/usr/local/lsws/bin/lswsctrl start

# Mantener el contenedor ejecutándose
echo "Servicios iniciados. El contenedor está funcionando..."
tail -f /usr/local/lsws/logs/error.log /var/log/nginx/error.log
