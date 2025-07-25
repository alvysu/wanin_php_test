FROM php:8.2-apache

# 建立 log 檔案及目錄
RUN mkdir -p /var/www/html && touch /var/www/html/status_log.txt

# 複製網站檔案
COPY first_level/ /var/www/html/

# 開放寫入權限（非常關鍵）
RUN chmod 666 /var/www/html/status_log.txt

# 啟用 mod_rewrite（如有 .htaccess）
RUN a2enmod rewrite

EXPOSE 80
