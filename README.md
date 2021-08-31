# Demo marketplace API

## Project setup
*this project requires PHP 8.0+*

1. copy `.env.example` file to `.env`.
2. install all composer dependency `composer install`.
3. generate application key `php artisan key:generate`.
4. update all the middleman account information in `.env` file.
5. create new database and change the database credentials in `.env` file.
6. migrate all the database tables `php artisan migrate`
7. symlink the storage folders `php artisan storage:link`
8. run the application `php artisan serve`
