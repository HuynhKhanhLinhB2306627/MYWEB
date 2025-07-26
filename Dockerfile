# Sử dụng image PHP chính thức với Apache để phục vụ web
FROM php:8.2-apache

# Cài đặt các extension PHP cần thiết
# pdo và pdo_pgsql là bắt buộc để kết nối với database PostgreSQL
RUN docker-php-ext-install pdo pdo_pgsql

# Cài đặt Composer (trình quản lý gói cho PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Kích hoạt module rewrite của Apache (quan trọng cho routing)
RUN a2enmod rewrite

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Sao chép mã nguồn của bạn vào thư mục web của container
# Lưu ý: file .htaccess sẽ được tự động sao chép
COPY . .

# Cài đặt các thư viện từ composer.json
RUN composer install --no-dev --optimize-autoloader

# Phân quyền cho thư mục public/Images để có thể upload file
RUN chown -R www-data:www-data public/Images

# Cổng mặc định của Apache là 80
EXPOSE 80