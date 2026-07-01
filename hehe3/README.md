# LuxeGems - Premium Jewelry Store

A modern, elegant jewelry e-commerce website built with Core PHP and MySQL.

## Features

### Public Features
- Homepage with hero banner, featured products, and best sellers
- Product catalog with categories and product details
- User authentication (login/register)
- Wishlist functionality
- Shopping cart
- Checkout with multiple payment methods
- Order history tracking
- Contact form
- Blog section
- Responsive design for all devices

### Admin Features
- Dashboard with sales analytics
- Product management (CRUD operations)
- Category management
- Order management
- Customer management
- Secure admin login

## Tech Stack

- **Backend**: Core PHP
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Animations**: AOS (Animate on Scroll)
- **Icons**: Bootstrap Icons

## Installation

1. **Requirements**
   - PHP 7.4 or higher
   - MySQL 5.7 or higher
   - Apache/Nginx web server (XAMPP/WAMP recommended for local development)

2. **Setup Database**
   - Create a MySQL database named `luxegems`
   - Import the database schema from `database/luxegems.sql`

3. **Configuration**
   - Update database credentials in `includes/config.php` if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'luxegems');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     ```

4. **Run the Application**
   - Place the project folder in your web server's document root
   - Access the website at `http://localhost/luxegems`

5. **Admin Access**
   - Visit `http://localhost/luxegems/admin`
   - Default credentials:
     - Username: `admin`
     - Password: `password` (Note: You should change this immediately after setup!)

## Project Structure

```
LuxeGems/
├── admin/                  # Admin dashboard
├── assets/                 # Frontend assets (CSS, JS, images)
├── database/               # Database schema
├── includes/               # Core PHP files (config, db, functions)
├── uploads/                # Uploaded files directory
├── index.php               # Homepage
├── shop.php                # Product catalog
├── product.php             # Product details
├── cart.php                # Shopping cart
├── checkout.php            # Checkout page
├── login.php               # User login
├── register.php            # User registration
└── ...                     # Other public pages
```

## Security Notes

- All user inputs are sanitized to prevent SQL injection
- Passwords are hashed using PHP's password_hash() function
- Session management is implemented for authentication
- Always use HTTPS in production
- Change default admin credentials immediately

## License

This project is for educational purposes.
