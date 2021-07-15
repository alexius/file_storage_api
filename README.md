# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Project description

This project should cover possibility to manage files (store, delete etc.) across different storages like local server, Amazon S3, FTP, Google Disc and other.
It can be extended by adding different file managers classes which work with different storage services. Factory method is being used.

## Authors
[Oleksii Kaharlytskyi](https://bitbucket.org/alexius33/file_storage_api/)

## How deploy the project
1. Checkout project from repository.
2. Run `composer install` command.
3. Create ".env" file.
4. Set in ".env" file your application key to a random string. Typically, this string should be 32 characters long. The key can be set in the .env environment file. Use command `php artisan key:generate` to generate a key.   
5. Set in ".env" file all needed data like credentials for accessing to the DB (Database) and other environment variables.
6. You should have installed MySQL on server.   
4. Run `php artisan migrate` to created "files" table in DB.
5. Configure your WEB server (Apache, Nginx...). The routes to perform API requests are:
  ```
  # Get file's information. GET Request
  http://your.domain/api/get-file-info/{file_id}
  
  # Get file (download). GET Request
  http://your.domain/api/file/{file_id}
  
  # Upload file to the storage. POST Request
  http://your.domain/api/upload
  
  # Upload file to the storage. DELETE Request
  http://your.domain/api/file{file_id}
  ```
