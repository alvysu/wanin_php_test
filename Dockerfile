# 使用 PHP 官方映像
FROM php:8.2-apache

# 複製你的程式碼到容器中
# COPY first_level/ /var/www/html/
COPY tmp/ /var/www/html/tmp/

# 啟用 Apache mod_rewrite（如有需要）
RUN a2enmod rewrite

# 設定權限（確保 log 可寫入）
RUN chmod -R 777 /var/www/html/tmp

# 開放 HTTP Port
EXPOSE 80
