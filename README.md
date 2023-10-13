# ResortableItem
It's a Laravel project that shows items by project and resort and store them.

## Install

### PHP
version: ^8.0
### Laravel
version: ^9.0

### Install composer
composer install

### Install npm
npm install<br />
npm run dev

## Env
copy .env.example .env<br />
php artisan key:generate<br />
php artisan config:cache<br />

## Database

### Mysql
DB_NAME: coalition_test
### Migration
php artisan migrate
### Generate items as default
php artisan db:seed

## Run server on local
php artisan serve
