#!/bin/bash
# ============================================================
# Server Setup Script for Ubuntu 22.04 (Timeweb Cloud VPS)
# Run as root: bash server-setup.sh
# ============================================================

set -e

echo "=============================="
echo " Installing system packages..."
echo "=============================="
apt update && apt upgrade -y
apt install -y curl git unzip ufw

# ---- Nginx ----
echo "=============================="
echo " Installing Nginx..."
echo "=============================="
apt install -y nginx
systemctl enable nginx
systemctl start nginx

# ---- PHP 8.2 ----
echo "=============================="
echo " Installing PHP 8.2..."
echo "=============================="
add-apt-repository ppa:ondrej/php -y
apt update
apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml \
    php8.2-curl php8.2-zip php8.2-gd php8.2-intl php8.2-bcmath php8.2-tokenizer
systemctl enable php8.2-fpm
systemctl start php8.2-fpm

# ---- MySQL 8 ----
echo "=============================="
echo " Installing MySQL 8..."
echo "=============================="
apt install -y mysql-server
systemctl enable mysql
systemctl start mysql

# ---- Composer ----
echo "=============================="
echo " Installing Composer..."
echo "=============================="
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

# ---- Node.js 20 ----
echo "=============================="
echo " Installing Node.js 20..."
echo "=============================="
curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
apt install -y nodejs

# ---- Firewall ----
echo "=============================="
echo " Configuring firewall..."
echo "=============================="
ufw allow OpenSSH
ufw allow 'Nginx Full'
ufw --force enable

# ---- MySQL: create DB and user ----
echo "=============================="
echo " Setting up MySQL database..."
echo "=============================="
read -rp "Enter database name [tour_agency]: " DB_NAME
DB_NAME=${DB_NAME:-tour_agency}
read -rp "Enter DB username [tour_user]: " DB_USER
DB_USER=${DB_USER:-tour_user}
read -rsp "Enter DB password: " DB_PASS
echo

mysql -u root <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_NAME}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';
GRANT ALL PRIVILEGES ON \`${DB_NAME}\`.* TO '${DB_USER}'@'localhost';
FLUSH PRIVILEGES;
SQL

echo ""
echo "=============================="
echo " Server setup complete!"
echo " DB: ${DB_NAME}  User: ${DB_USER}"
echo " Next: run deploy.sh"
echo "=============================="
