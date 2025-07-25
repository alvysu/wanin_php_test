FROM php:8.2-apache

# 建立 log 目錄並給權限
RUN mkdir -p /var/www/html/tmp && chmod -R 777 /var/www/html/tmp

# 複製網站主程式
COPY first_level/ /var/www/html/

# 複製 log 資料夾（要有 status_log.txt）
COPY tmp/ /var/www/html/tmp/

# 避免 tmp 被重蓋後權限異常
RUN chmod -R 777 /var/www/html/tmp

# 開啟 Apache rewrite 模組（如果有用 .htaccess）
RUN a2enmod rewrite

EXPOSE 80
