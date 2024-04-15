# Gunakan image resmi PHP sebagai base image
FROM php:7.4-apache

# Set direktori kerja
WORKDIR /var/www/html

# Install git
RUN apt-get update && apt-get install -y git

# Remove default contents in /var/www/html
RUN rm -rf /var/www/html/*

# Clone repository from GitHub
RUN git clone https://github.com/setrasariputra/simpleUploadFile-PHP.git /var/www/html

RUN chown -R www-data:www-data /var/www/html/uploads
RUN chmod -R 755 /var/www/html/uploads


# Expose port 80
EXPOSE 80

# Tambahkan volume untuk folder uploads
VOLUME /var/www/html/uploads