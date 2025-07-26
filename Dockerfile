FROM php:8.2-cli

# Cài đặt extension nếu cần (tùy theo project, có thể bỏ dòng dưới nếu không cần DB)
# RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ mã nguồn vào container
COPY . /app
WORKDIR /app

# Expose cổng Render yêu cầu
EXPOSE 10000

# Chạy PHP server tại thư mục public (thường có index.php ở đó)
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
