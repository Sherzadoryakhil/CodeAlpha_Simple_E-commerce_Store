# Laravel E-commerce Store

A simple e-commerce website built with **Laravel**, **Blade**, **Tailwind CSS** and **JavaScript**. Customers can browse products, add them to a cart, register or log in, and place orders. An admin panel manages products and order statuses.

## Features

- Product listing with search, category filter and pagination
- Product details page with related products
- Shopping cart (session based, works for guests): add, update, remove
- User registration and login (Laravel Breeze)
- Checkout with order processing (database transaction, stock reduced automatically)
- Order history and order details for each customer
- Admin panel: create, edit and delete products (with image upload), and update order statuses
- Database for products, categories, users, orders and order items
- Automated feature tests

## Tech Stack

- **Backend:** Laravel (PHP 8.2+)
- **Frontend:** Blade, Tailwind CSS, JavaScript (Vite)
- **Database:** SQLite (default) or MySQL
- **Authentication:** Laravel Breeze

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm

## Installation

```bash
git clone https://github.com/YOUR_USERNAME/ecommerce-store.git
cd ecommerce-store

composer install
npm install

cp .env.example .env        # Windows: copy .env.example .env
php artisan key:generate
```

### Database setup (SQLite)

Create the database file:

```bash
touch database/database.sqlite      # Windows: type nul > database\database.sqlite
```

In `.env` make sure you have:

```
DB_CONNECTION=sqlite
```

(For MySQL, set `DB_CONNECTION=mysql`, `DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`, and create the database first.)

### Migrate, seed and link storage

```bash
php artisan migrate --seed
php artisan storage:link
```

## Running the project

Open two terminals:

```bash
npm run dev
```

```bash
php artisan serve
```

Then open http://127.0.0.1:8000

## Default admin account

Created by the seeder:

| Email | Password |
|-------|----------|
| admin@example.com | password |

**Change this password before deploying the site online.**

## Running tests

```bash
php artisan test
```

## Project structure

| Path | Purpose |
|------|---------|
| `app/Models` | Category, Product, Order, OrderItem, User |
| `app/Http/Controllers` | Product, Cart and Order controllers |
| `app/Http/Controllers/Admin` | Admin product and order management |
| `app/Http/Middleware/AdminMiddleware.php` | Restricts admin pages |
| `database/migrations` | Database tables |
| `database/seeders` | Sample data and admin user |
| `resources/views` | Blade templates |
| `routes/web.php` | Application routes |
| `tests/Feature/StoreTest.php` | Store feature tests |

## Main routes

| URL | Description |
|-----|-------------|
| `/` | Product listing |
| `/products/{slug}` | Product details |
| `/cart` | Shopping cart |
| `/checkout` | Checkout (login required) |
| `/orders` | My orders (login required) |
| `/admin/products` | Manage products (admin only) |
| `/admin/orders` | Manage orders (admin only) |

## Before going live

- Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
- Change the default admin email and password
- Run `npm run build`
- Run `php artisan config:cache && php artisan route:cache`

## Possible improvements

- Online payment (Stripe)
- Order confirmation emails
- Product reviews and ratings
- Wishlist

## Author

Sherzad Oryakhil - CodeAlpha Internship, Task 1.

## License

This project is open-source and available under the [MIT license](https://opensource.org/licenses/MIT).
