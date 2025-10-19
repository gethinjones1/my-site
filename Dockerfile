
# Use official PHP with Apache
FROM php:8.2-apache

# Copy your PHP files into the container
COPY . /var/www/html/
