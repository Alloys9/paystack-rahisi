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
composer require alloys9/paystack_rahisi:dev-main@dev

```

### Step 2: Run the installation command
After installing the package, run the following Artisan command to set up the package:

```bash
php artisan paystack-rahisi:install
```
This command will:

- Copy controllers to app/Http/Controllers
- Copy migrations to database/migrations
- Copy models to app/Models
- Copy views to resources/views
- Append necessary routes to routes/web.php

### Step 3: Migrate the database
Run the following command to migrate the necessary database tables:
```bash
php artisan migrate
```

Then you are done! That simple!
### If an error occurs run
```bash
php artisan vendor:publish --provider="Alloys9\PaystackRahisi\PaystackServiceProvider"
```

Then run
```bash
php artisan paystack-rahisi:install
```

## License
This package is open-sourced software licensed under the MIT license.

MIT License

Copyright 2024 Alloys Amasakha

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

