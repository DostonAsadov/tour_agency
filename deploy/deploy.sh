#!/bin/bash
# ============================================================
# Deploy Script — Shirin Travel Agency
# Usage: bash deploy.sh
# Run from /var/www after server-setup.sh is done
# ============================================================

set -e

REPO="https://github.com/DostonAsadov/tour_agency.git"
APP_DIR="/var/www/tour_agency"
NGINX_CONF="/etc/nginx/sites-available/tour_agency"

echo "=============================="
echo " Cloning repository..."
echo "=============================="
cd /var/www
git clone "$REPO" tour_agency
cd "$APP_DIR"

# ---- Composer dependencies (no dev) ----
echo "=============================="
echo " Installing PHP dependencies..."
echo "=============================="
composer install --no-dev --optimize-autoloader --no-interaction

# ---- Frontend build ----
echo "=============================="
echo " Building frontend assets..."
echo "=============================="
npm ci
npm run build
rm -rf node_modules

# ---- Environment file ----
echo "=============================="
echo " Setting up .env..."
echo "=============================="
cp deploy/.env.production .env
php artisan key:generate --force

echo ""
echo "IMPORTANT: Edit .env now and set:"
echo "  DB_DATABASE, DB_USERNAME, DB_PASSWORD"
echo "  APP_URL"
echo "  GOOGLE_SHEETS_SPREADSHEET_ID"
echo ""
read -rp "Press Enter after editing .env to continue..."

# ---- Storage setup ----
echo "=============================="
echo " Setting up storage..."
echo "=============================="
php artisan storage:link

# ---- Upload Google service account ----
echo "=============================="
echo " Google service account..."
echo "=============================="
echo "Upload your google-service-account.json to:"
echo "  ${APP_DIR}/storage/app/google-service-account.json"
echo ""
read -rp "Press Enter after uploading the file..."

# ---- Database migrations ----
echo "=============================="
echo " Running migrations..."
echo "=============================="
php artisan migrate --force

# ---- Laravel optimizations ----
echo "=============================="
echo " Optimizing Laravel..."
echo "=============================="
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ---- Permissions ----
echo "=============================="
echo " Setting permissions..."
echo "=============================="
chown -R www-data:www-data "$APP_DIR"
chmod -R 755 "$APP_DIR"
chmod -R 775 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"

# ---- Nginx config ----
echo "=============================="
echo " Configuring Nginx..."
echo "=============================="
cp deploy/nginx.conf "$NGINX_CONF"

echo ""
read -rp "Enter your domain (e.g. shirintravel.uz): " DOMAIN
sed -i "s/your-domain.com/$DOMAIN/g" "$NGINX_CONF"

ln -sf "$NGINX_CONF" /etc/nginx/sites-enabled/tour_agency
rm -f /etc/nginx/sites-enabled/default
nginx -t && systemctl reload nginx

# ---- SSL with Let's Encrypt ----
echo "=============================="
echo " Setting up SSL (Let's Encrypt)..."
echo "=============================="
apt install -y certbot python3-certbot-nginx
certbot --nginx -d "$DOMAIN" -d "www.$DOMAIN" --non-interactive --agree-tos \
    --email "doston.doc@gmail.com" --redirect

systemctl reload nginx

echo ""
echo "=============================="
echo " Deployment complete!"
echo " Site: https://${DOMAIN}"
echo " Admin: https://${DOMAIN}/admin"
echo "=============================="
