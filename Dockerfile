FROM php:8.1-apache

# Aktifkan ekstensi MySQL
RUN docker-php-ext-install mysqli

# Aktifkan mod_rewrite dan ubah konfigurasi agar .htaccess bekerja
RUN a2enmod rewrite && \
    sed -i 's/AllowOverride None/AllowOverride All/i' /etc/apache2/apache2.conf

# Salin file project ke folder web server
COPY . /var/www/html/

# Beri izin agar file bisa diakses Apache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
