# To-Do Back-End API

An API to manage a to-do list built with Laravel.

## Getting Started

### Prerequisites

```bash
php -v
composer -V
mysql -V
```

### Installing

Clone this repo.

```bash
git clone https://github.com/framadhan99/todo-api
```

Copy .env.

```bash
cd laravel-todo-backend-api
cp .env.example .env
```

Install the project dependencies.

```bash
composer i
```

Create database and migrate.

```bash
mysql -uroot -p -e "CREATE DATABASE todo"
php artisan migrate --seed
```

Set the application key.

```bash
php artisan key:generate
```

Serve the application on the PHP development server.

```bash
php artisan serve
```

List all registered routes.

```bash
php artisan route:list
```

Enjoy!

## Built With

* Laravel
