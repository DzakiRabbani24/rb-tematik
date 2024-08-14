<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How To Use

1. Run composer install as usual after cloning this repository
2. Make sure you have a database with the name rb_tematik, if not, follow the configuration first
3. Then run php artisan migrate to migrate the database
4. After that, run php artisan db:seed to fill in the users table, so you can log in with admin credentials (Usn : admin.123__Pass : admin.123)
5. Finally run php artisan key:generate as usual

## Configuration
1. If you don't have a rb_tematik database in your database, create one first. Or run the following command (CREATE DATABASE rb_tematik;)
2. Next, look for the .env file that you copied previously and change this part
DB_DATABASE=rb_tematik
DB_USERNAME=root
DB_PASSWORD=
4. Copy the .env.example file and rename it to .env or run the following command cp .env.example .env
5. Continue to the "**How To Use**" section, point 3

## If there is an error with the rb_tematik database that you have
1. Make sure that in your rb_tematik database there are tables with the names paper_kerja_renaksi, regional_device, and users
2. If not, run the **How to Use** and **Configuration** section above
3. If it still doesn't work, create a table manually based on the contents of the files in the migration folder
