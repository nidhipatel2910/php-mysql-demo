# Use the official PHP with Apache image
FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy all PHP scripts and files into the container
COPY src/ /var/www/html/

# Expose port 80
EXPOSE 80



