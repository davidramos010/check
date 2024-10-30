# Usamos una imagen con PHP 8
FROM yiisoftware/yii2-php:8.1-apache

# Instalar y configurar Xdebug
RUN pecl uninstall xdebug || true && \
    pecl install xdebug-3.1.5 && \
    docker-php-ext-enable xdebug && \
    touch /tmp/xdebug.log && \
    chmod -R 777 /tmp/xdebug.log && \
    apt update && \
    apt install -y vim && \
    rm -rf /var/lib/apt/lists/*

# Copia los archivos de configuración de PHP y Xdebug
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
