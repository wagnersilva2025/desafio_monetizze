# Usar uma imagem base do PHP com Apache
FROM php:8.1-apache

# Instalar as extensões do PHP necessárias (pdo, pdo_mysql)
RUN docker-php-ext-install pdo pdo_mysql

# Definir o diretório de trabalho
WORKDIR /var/www/html
