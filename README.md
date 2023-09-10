# Backoffice Hollydice Palace

### first create your local env
create .env on your project root and insert this:
```
EXTERNAL_API_BASE_URL=https://api.github.com
```
or you can duplicate the .env.example file then rename it to .env

## Project setup
```
composer install
```

generate key
```
php artisan key:generate
```

setup your database in env then run
```
php artisan migrate
```

run project
```
php artisan serve
```
