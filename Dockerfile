# 使用 PHP 官方映像
FROM php:8.2-apache

# 建立 log 資料夾並設定權限（提早執行）
RUN mkdir -p /var/www/html/tmp && chmod -R 777 /var/www/html/tmp

# 複製你的程式碼
COPY first_level/ /var/www/html/
COPY tmp/ /var/www/html/tmp/

# 啟用 Apache mod_rewrite（如有需要）
RUN a2enmod rewrite

# 確保 tmp 資料夾寫入權限仍在
RUN chmod -R 777 /var/www/html/tmp

# 開放 HTTP Port
EXPOSE 80
