## TEMPER PHP ASSESMENT

Retention curve chart that shows how far a group of users (weekly cohorts) has progressed through the Onboarding Flow

## Prerequisites

- PHP 7.1
- Mysql
- Composer

## Installation

- composer update
- Rename .env.example to .env and provide your database details there.
- Create Database and put Databse name in .env file (DB_DATABASE)
- Database username in 'root' (DB_USERNAME)
- Change DB Password in .env file (If any), otherwise leave blank(DB_PASSWORD)
- php artisan migrate
- php artisan db:seed
- php artisan key:generate
- php artisan serve
- RUN http://127.0.0.1:8000 in your browser

## Testing

- phpunit 6.0
- vendor\bin\phpunit
