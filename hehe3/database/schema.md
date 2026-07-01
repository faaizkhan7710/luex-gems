# LuxeGems Database Schema

## Overview

This document describes the complete database schema for the LuxeGems jewelry e-commerce website.

---

## Tables

### 1. admins

Stores admin user accounts for the admin dashboard.

| Column      | Type         | Null | Key | Default             | Extra          |
|-----------|--------------|------|-----|---------------------|----------------|
| id        | int          | NO   | PRI | NULL                | auto_increment |
| username  | varchar(50)  | NO   | UNI | NULL                |                |
| email     | varchar(100)| NO   | UNI | NULL                |                |
| password  | varchar(255)| NO   |     | NULL                |                |
| created_at| timestamp    | NO   |     | CURRENT_TIMESTAMP   |                |

---

### 2. users

Stores customer user accounts.

| Column      | Type         | Null | Key | Default             | Extra          |
|-------------|--------------|------|-----|---------------------|----------------|
| id          | int          | NO   | PRI | NULL                | auto_increment |
| name        | varchar(100)| NO   |     | NULL                |                |
| email       | varchar(100)| NO   | UNI | NULL                |                |
| password    | varchar(255)| NO   |     | NULL                |                |
| phone       | varchar(20)  | YES  |     | NULL                |                |
| address     | text         | YES  |     | NULL                |                |
| created_at  | timestamp    | NO   |     | CURRENT_TIMESTAMP   |                |

---

### 3. categories

Stores product categories.

| Column        | Type         | Null | Key | Default             | Extra          |
|---------------|--------------|------|-----|---------------------|----------------|
| id            | int          | NO   | PRI | NULL                | auto_increment |
| name          | varchar(100)| NO   |     | NULL                |                |
| slug          | varchar(100)| NO   | UNI | NULL                |                |
| description   | text         | YES  |     | NULL                |                |
| created_at  | timestamp    | NO   |     | CURRENT_TIMESTAMP   |                |

---

### 4. products

Stores product information.

| Column          | Type          | Null | Key | Default             | Extra          |
|-----------------|---------------|------|-----|---------------------|----------------|
| id              | int           | NO   | PRI | NULL                | auto_increment |
| category_id     | int           | YES  | MUL | NULL                |                |
| name            | varchar(255)| NO   |     | NULL                |                |
| slug            | varchar(255)| NO   | UNI | NULL                |                |
| description     | text          | YES  |     | NULL                |                |
| price           | decimal(10,2)| NO   |     | NULL                |                |
| sale_price    | decimal(10,2)| YES  |     | NULL                |                |
| stock           | int           | NO   |     | 0                   |                |
| is_featured   | tinyint(1)  | NO   |     | 0                   |                |
| is_bestseller| tinyint(1)  | NO   |     | 0                   |                |
| created_at    | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

**Foreign Keys:**
- `category_id` → `categories(id)` (ON DELETE SET NULL)

---

### 5. product_images

Stores multiple images per product.

| Column         | Type          | Null | Key | Default             | Extra          |
|----------------|---------------|------|-----|---------------------|----------------|
| id             | int           | NO   | PRI | NULL                | auto_increment |
| product_id   | int           | NO   | MUL | NULL                |                |
| image_path | varchar(255)| NO   |     | NULL                |                |
| is_primary   | tinyint(1)  | NO   |     | 0                   |                |

**Foreign Keys:**
- `product_id` → `products(id)` (ON DELETE CASCADE)

---

### 6. orders

Stores order information.

| Column               | Type          | Null | Key | Default             | Extra          |
|--------------------|---------------|------|-----|---------------------|----------------|
| id                 | int           | NO   | PRI | NULL                | auto_increment |
| user_id          | int           | YES  | MUL | NULL                |                |
| total              | decimal(10,2)| NO   |     | NULL                |                |
| status             | varchar(50) | NO   |     | 'pending'           |                |
| payment_method     | varchar(50) | YES  |     | NULL                |                |
| shipping_address | text          | YES  |     | NULL                |                |
| created_at       | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

**Foreign Keys:**
- `user_id` → `users(id)` (ON DELETE SET NULL)

---

### 7. order_items

Stores individual items within each order.

| Column         | Type          | Null | Key | Default             | Extra          |
|----------------|---------------|------|-----|---------------------|----------------|
| id             | int           | NO   | PRI | NULL                | auto_increment |
| order_id     | int           | NO   | MUL | NULL                |                |
| product_id | int           | NO   | MUL | NULL                |                |
| quantity       | int           | NO   |     | NULL                |                |
| price          | decimal(10,2)| NO   |     | NULL                |                |

**Foreign Keys:**
- `order_id` → `orders(id)` (ON DELETE CASCADE)
- `product_id` → `products(id)` (ON DELETE CASCADE)

---

### 8. wishlist

Stores user wishlist items for users.

| Column         | Type      | Null | Key | Default             | Extra          |
|----------------|-----------|------|-----|---------------------|----------------|
| id             | int       | NO   | PRI | NULL                | auto_increment |
| user_id     | int       | NO   | MUL | NULL                |                |
| product_id | int       | NO   | MUL | NULL                |                |
| created_at | timestamp | NO   |     | CURRENT_TIMESTAMP   |                |

**Foreign Keys:**
- `user_id` → `users(id)` (ON DELETE CASCADE)
- `product_id` → `products(id)` (ON DELETE CASCADE)
- **Unique Constraint:** `(user_id, product_id)`

---

### 9. cart

Stores shopping cart items for users.

| Column         | Type      | Null | Key | Default             | Extra          |
|----------------|-----------|------|-----|---------------------|----------------|
| id             | int       | NO   | PRI | NULL                | auto_increment |
| user_id     | int       | YES  | MUL | NULL                |                |
| product_id | int       | NO   | MUL | NULL                |                |
| quantity       | int       | NO   |     | 1                   |                |
| created_at | timestamp | NO   |     | CURRENT_TIMESTAMP   |                |

**Foreign Keys:**
- `user_id` → `users(id)` (ON DELETE CASCADE)
- `product_id` → `products(id)` (ON DELETE CASCADE)

---

### 10. payments

Stores payment information for orders.

| Column              | Type          | Null | Key | Default             | Extra          |
|---------------------|---------------|------|-----|---------------------|----------------|
| id                  | int           | NO   | PRI | NULL                | auto_increment |
| order_id         | int           | NO   | MUL | NULL                |                |
| amount              | decimal(10,2)| NO   |     | NULL                |                |
| method              | varchar(50) | YES  |     | NULL                |                |
| status              | varchar(50) | YES  |     | NULL                |                |
| transaction_id  | varchar(255)| YES  |     | NULL                |                |
| created_at      | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

**Foreign Keys:**
- `order_id` → `orders(id)` (ON DELETE CASCADE)

---

### 11. reviews

Stores product reviews and ratings from customers.

| Column         | Type      | Null | Key | Default             | Extra          |
|----------------|-----------|------|-----|---------------------|----------------|
| id             | int       | NO   | PRI | NULL                | auto_increment |
| user_id     | int       | YES  | MUL | NULL                |                |
| product_id | int       | NO   | MUL | NULL                |                |
| rating         | int       | NO   |     | NULL                |                |
| comment        | text      | YES  |     | NULL                |                |
| created_at | timestamp | NO   |     | CURRENT_TIMESTAMP   |                |

**Foreign Keys:**
- `user_id` → `users(id)` (ON DELETE SET NULL)
- `product_id` → `products(id)` (ON DELETE CASCADE)

---

### 12. coupons

Stores discount coupons for promotions.

| Column          | Type          | Null | Key | Default             | Extra          |
|-----------------|---------------|------|-----|---------------------|----------------|
| id              | int           | NO   | PRI | NULL                | auto_increment |
| code            | varchar(50) | NO   | UNI | NULL                |                |
| discount        | decimal(5,2) | NO   |     | NULL                |                |
| type            | enum        | NO   |     | NULL                |                |
| min_order       | decimal(10,2)| YES  |     | NULL                |                |
| usage_limit     | int           | YES  |     | NULL                |                |
| used_count      | int           | NO   |     | 0                   |                |
| expires_at      | date          | YES  |     | NULL                |                |
| created_at      | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

**Enum Values for `type`:
- 'percentage'
- 'fixed'

---

### 13. banners

Stores banner images for homepage and promotions.

| Column         | Type          | Null | Key | Default             | Extra          |
|----------------|---------------|------|-----|---------------------|----------------|
| id             | int           | NO   | PRI | NULL                | auto_increment |
| title          | varchar(255)| YES  |     | NULL                |                |
| subtitle       | varchar(255)| YES  |     | NULL                |                |
| image_path | varchar(255)| YES  |     | NULL                |                |
| link           | varchar(255)| YES  |     | NULL                |                |
| is_active      | tinyint(1)  | NO   |     | 1                   |                |
| created_at | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

---

### 14. contact_messages

Stores messages from the contact form.

| Column         | Type          | Null | Key | Default             | Extra          |
|----------------|---------------|------|-----|---------------------|----------------|
| id             | int           | NO   | PRI | NULL                | auto_increment |
| name           | varchar(100)| NO   |     | NULL                |                |
| email          | varchar(100)| NO   |     | NULL                |                |
| subject        | varchar(255)| YES  |     | NULL                |                |
| message        | text          | NO   |     | NULL                |                |
| created_at | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

---

### 15. newsletter

Stores email subscribers for the newsletter.

| Column             | Type          | Null | Key | Default             | Extra          |
|--------------------|---------------|------|-----|---------------------|----------------|
| id                 | int           | NO   | PRI | NULL                | auto_increment |
| email              | varchar(100)| NO   | UNI | NULL                |                |
| subscribed_at | timestamp     | NO   |     | CURRENT_TIMESTAMP   |                |

---

### 16. settings

Stores general website settings.

| Column            | Type          | Null | Key | Default             | Extra          |
|-----------------|---------------|------|-----|---------------------|----------------|
| id              | int           | NO   | PRI | NULL                | auto_increment |
| setting_key     | varchar(100)| NO   | UNI | NULL                |                |
| setting_value   | text          | YES  |     | NULL                |                |
| updated_at      | timestamp     | NO   |     | CURRENT_TIMESTAMP   | ON UPDATE CURRENT_TIMESTAMP |

---

## Default Data

The SQL file includes:
- 1 admin user (username: admin, password: password)
- 5 product categories
- 5 sample products
