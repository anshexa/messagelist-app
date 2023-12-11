FROM php:8.2-apache

# Установка необходимых расширений PHP, включая драйвер MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql
