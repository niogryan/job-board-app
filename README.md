# Laravel Project Setup Guide

⚠️ Make sure you have **MySQL** installed and running locally before proceeding

Follow these steps to set up and run the Laravel application after cloning the repository.

## 1. Clone the Repository

```bash
git clone https://github.com/niogryan/job-board-app.git
cd job-board-app
```

## 2. Install Dependencies

Make sure you have Composer and Node.js installed.

```bash
composer install
npm install
```

## 3.Set Up Environment File

Copy the example environment file and create a new `.env` file:

```bash
cp .env.example .env
```

## 4. Then open .env in any text editor and update these values as needed:

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

## 5. Generate Application Key

```bash
php artisan key:generate
```

## 6. Run Database Migrations

```bash
php artisan migrate
```

## 7. Start the Local Development Server

```bash
php artisan serve
```

## Then open your browser at:

http://127.0.0.1:8000
