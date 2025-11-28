@echo off
echo Starting SmartMedia Frontend + Laravel...

:: Start Vite / React
start cmd /k "cd smartmedia-frontend && npm run dev"

:: Start Laravel
start cmd /k "php artisan serve"

exit
