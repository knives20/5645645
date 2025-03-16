#!/bin/bash
set -e

# Iniciar PHP-FPM en segundo plano
php-fpm -D

# Iniciar Nginx en segundo plano
nginx -g "daemon off;" &

# Iniciar OpenLiteSpeed en segundo plano
/usr/local/lsws/bin/lswsctrl start

# Mantener el contenedor ejecutándose
echo "Servicios iniciados. El contenedor está funcionando..."
tail -f /usr/local/lsws/logs/error.log /var/log/nginx/error.log
