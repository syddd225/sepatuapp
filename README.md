# How to Install sepatuapp

1. Download and extract or clone the project into `laragon/www` or `xampp/htdocs`
2. Duplicate and rename `.env.example` file into `.env`, then configure the `.env` file according to your own needs
3. Open the project's terminal and run:

```
composer install
```

note: when running the command below, choose yes if the database is not yet created

```
php artisan migrate --seed
```

```
php artisan key:generate
```

```
php artisan serve
```