# 使用 PHP 官方映像
FROM php:8.2-apache

# 複製你的程式碼到容器中
COPY . /var/www/html/

# 啟用 Apache mod_rewrite（如果你需要）
RUN a2enmod rewrite

# 設定權限（如有 logs 資料夾）
RUN mkdir -p /var/www/html/logs && chmod -R 777 /var/www/html/logs

# 開放 HTTP Port
EXPOSE 80
