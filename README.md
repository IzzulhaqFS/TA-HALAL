# Setup TA-HALAL Web
1. Download file backup db
2. Clone repo TA-HALAL
3. Create .env file
4. Create database (mysql)
5. Run: composer install
6. Run: php artisan key:generate
7. Run: php artisan migrate
8. Import backup db to mysql database
9. Run: php artisan db:seed
10. Run: php artisan serve
11. Login with account generated from seeder
