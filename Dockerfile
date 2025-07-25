FROM php:8.2-apache

# 複製整個網站程式（包含 status_log.txt）
COPY first_level/ /var/www/html/

# 確保 log 檔有寫入權限
RUN chmod 666 /var/www/html/status_log.txt

# 開啟 Apache rewrite 模組（如有使用 .htaccess 可保留）
RUN a2enmod rewrite

EXPOSE 80
