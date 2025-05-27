@echo off
php artisan migrate --seed
php artisan serve
pause