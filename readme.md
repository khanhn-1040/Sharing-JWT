# Sharing Json Web Token 

## Set up project 

- `cp .env.example .env`
- `composer install --no-scripts`
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan jwt:secret`