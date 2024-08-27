# Paystack Rahisi

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

**Paystack Rahisi** is a simple PHP library for integrating the Paystack API with Laravel applications. It provides an easy-to-use interface to handle various Paystack functionalities, streamlining the payment processing experience for developers.

## Features
- Simple and straightforward integration with Paystack API
- Automatic setup of controllers, migrations, models, views, and routes
- Designed to work seamlessly with Laravel 8.x and above

## Installation

To get started with Paystack Rahisi, follow these steps:

### Step 1: Install the package via Composer

```bash
composer require alloys9/paystack_rahisi

```

### Step 2: Run the installation command
After installing the package, run the following Artisan command to set up the package:

```bash
php artisan paystack-rahisi:install
```
This command will:

Copy controllers to app/Http/Controllers
Copy migrations to database/migrations
Copy models to app/Models
Copy views to resources/views
Append necessary routes to routes/web.php

## Step 3: Migrate the database
Run the following command to migrate the necessary database tables:
```bash
php artisan migrate
```
