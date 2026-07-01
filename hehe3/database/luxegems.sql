CREATE DATABASE IF NOT EXISTS luxegems;
USE luxegems;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    sale_price DECIMAL(10,2),
    stock INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    is_bestseller BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    payment_method VARCHAR(50),
    shipping_address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS wishlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_wishlist (user_id, product_id)
);

CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    method VARCHAR(50),
    status VARCHAR(50),
    transaction_id VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS coupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    discount DECIMAL(5,2) NOT NULL,
    type ENUM('percentage', 'fixed') NOT NULL,
    min_order DECIMAL(10,2),
    usage_limit INT,
    used_count INT DEFAULT 0,
    expires_at DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    subtitle VARCHAR(255),
    image_path VARCHAR(255),
    link VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO admins (username, email, password) VALUES 
('admin', 'admin@luxegems.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcfl7p92ldGxad68LJZdL17lhWy');

INSERT INTO categories (name, slug, description) VALUES 
('Rings', 'rings', 'Elegant rings for every occasion'),
('Necklaces', 'necklaces', 'Beautiful necklaces and pendants'),
('Earrings', 'earrings', 'Stylish earrings for all styles'),
('Bracelets', 'bracelets', 'Charming bracelets and bangles'),
('Watches', 'watches', 'Luxury watches for men and women');

INSERT INTO products (category_id, name, slug, description, price, stock, is_featured, is_bestseller) VALUES 
-- Rings (category_id=1) - 20 products
(1, 'Diamond Solitaire Ring', 'diamond-solitaire-ring', 'Classic diamond solitaire ring in 18k gold', 1299.99, 10, 1, 1),
(1, 'Pink Sapphire Ring', 'pink-sapphire-ring', 'Gorgeous pink sapphire ring in rose gold', 1599.99, 8, 1, 1),
(1, 'Emerald Cut Ring', 'emerald-cut-ring', 'Stunning emerald cut diamond ring', 2499.99, 6, 0, 0),
(1, 'Halo Diamond Ring', 'halo-diamond-ring', 'Beautiful halo diamond engagement ring', 3999.99, 4, 1, 0),
(1, 'Rose Gold Infinity Ring', 'rose-gold-infinity-ring', 'Elegant infinity symbol ring in rose gold', 299.99, 30, 1, 1),
(1, 'Vintage Sapphire Ring', 'vintage-sapphire-ring', 'Vintage-inspired blue sapphire ring', 1899.99, 7, 0, 0),
(1, 'Solitaire CZ Ring', 'solitaire-cz-ring', 'Stunning cubic zirconia solitaire ring', 89.99, 50, 1, 0),
(1, 'Three Stone Diamond Ring', 'three-stone-diamond-ring', 'Beautiful three-stone diamond ring', 2299.99, 5, 1, 1),
(1, 'Rose Gold Stackable Ring', 'rose-gold-stackable-ring', 'Delicate stackable ring in rose gold', 129.99, 40, 0, 0),
(1, 'Amethyst Promise Ring', 'amethyst-promise-ring', 'Lovely amethyst promise ring', 199.99, 25, 1, 0),
(1, 'White Gold Halo Ring', 'white-gold-halo-ring', 'Elegant white gold halo ring', 1799.99, 8, 0, 1),
(1, 'Morganite Engagement Ring', 'morganite-engagement-ring', 'Stunning morganite engagement ring', 1499.99, 6, 1, 0),
(1, 'Silver Moon Ring', 'silver-moon-ring', 'Cute moon design ring in sterling silver', 79.99, 45, 0, 0),
(1, 'Ruby Solitaire Ring', 'ruby-solitaire-ring', 'Classic ruby solitaire ring', 1999.99, 5, 1, 1),
(1, 'Rose Gold Floral Ring', 'rose-gold-floral-ring', 'Beautiful floral design ring in rose gold', 249.99, 28, 0, 0),
(1, 'Opal Stack Ring', 'opal-stack-ring', 'Gorgeous opal stackable ring', 159.99, 35, 1, 0),
(1, 'Black Diamond Ring', 'black-diamond-ring', 'Edgy black diamond ring', 899.99, 12, 0, 1),
(1, 'Aquamarine Cocktail Ring', 'aquamarine-cocktail-ring', 'Beautiful aquamarine cocktail ring', 1299.99, 9, 1, 0),
(1, 'Rose Gold Knot Ring', 'rose-gold-knot-ring', 'Elegant knot design ring in rose gold', 189.99, 32, 0, 0),
(1, 'Peridot Statement Ring', 'peridot-statement-ring', 'Bold peridot statement ring', 399.99, 18, 1, 1),
-- Necklaces (category_id=2) - 20 products
(2, 'Pearl Pendant Necklace', 'pearl-pendant-necklace', 'Elegant freshwater pearl pendant', 499.99, 15, 1, 0),
(2, 'Rose Gold Heart Necklace', 'rose-gold-heart-necklace', 'Adorable rose gold heart pendant necklace', 349.99, 20, 1, 1),
(2, 'Layered Beaded Necklace', 'layered-beaded-necklace', 'Trendy layered beaded necklace in pink tones', 159.99, 25, 1, 0),
(2, 'Silver Bar Necklace', 'silver-bar-necklace', 'Minimalist silver bar necklace', 99.99, 40, 0, 1),
(2, 'Diamond Solitaire Necklace', 'diamond-solitaire-necklace', 'Classic diamond solitaire pendant', 899.99, 12, 1, 0),
(2, 'Rose Gold Flower Necklace', 'rose-gold-flower-necklace', 'Beautiful flower pendant in rose gold', 199.99, 30, 0, 0),
(2, 'Moonstone Pendant Necklace', 'moonstone-pendant-necklace', 'Stunning moonstone pendant necklace', 249.99, 22, 1, 1),
(2, 'Gold Name Necklace', 'gold-name-necklace', 'Personalized gold name necklace', 179.99, 28, 0, 0),
(2, 'Infinity Knot Necklace', 'infinity-knot-necklace', 'Elegant infinity knot necklace', 149.99, 35, 1, 0),
(2, 'Choker Necklace Set', 'choker-necklace-set', 'Cute set of 3 choker necklaces', 89.99, 45, 0, 1),
(2, 'Pink Tourmaline Necklace', 'pink-tourmaline-necklace', 'Beautiful pink tourmaline pendant', 499.99, 15, 1, 0),
(2, 'Layered Chain Necklace', 'layered-chain-necklace', 'Trendy layered chain necklace', 129.99, 38, 0, 0),
(2, 'Lariat Necklace', 'lariat-necklace', 'Stylish lariat necklace in gold', 169.99, 24, 1, 1),
(2, 'Blue Topaz Pendant', 'blue-topaz-pendant', 'Gorgeous blue topaz pendant necklace', 299.99, 18, 0, 0),
(2, 'Rose Gold Initial Necklace', 'rose-gold-initial-necklace', 'Personalized rose gold initial pendant', 139.99, 32, 1, 0),
(2, 'Pearl Strand Necklace', 'pearl-strand-necklace', 'Classic freshwater pearl strand', 399.99, 14, 0, 1),
(2, 'Lock Necklace', 'lock-necklace', 'Trendy lock pendant necklace', 119.99, 42, 1, 0),
(2, 'Citrine Pendant Necklace', 'citrine-pendant-necklace', 'Beautiful citrine pendant necklace', 229.99, 20, 0, 0),
(2, 'Rose Gold Layered Necklace', 'rose-gold-layered-necklace', 'Elegant rose gold layered necklace', 189.99, 26, 1, 1),
(2, 'Star Pendant Necklace', 'star-pendant-necklace', 'Cute star pendant necklace in silver', 89.99, 48, 0, 0),
-- Earrings (category_id=3) - 20 products
(3, 'Gold Hoop Earrings', 'gold-hoop-earrings', 'Timeless gold hoop earrings', 299.99, 20, 0, 1),
(3, 'Pearl Stud Earrings', 'pearl-stud-earrings', 'Classic pearl stud earrings, perfect for everyday', 129.99, 30, 0, 1),
(3, 'Dangle Earrings Set', 'dangle-earrings-set', 'Cute set of 3 dangle earrings', 79.99, 40, 0, 1),
(3, 'Diamond Stud Earrings', 'diamond-stud-earrings', 'Classic diamond stud earrings', 799.99, 10, 1, 0),
(3, 'Rose Gold Drop Earrings', 'rose-gold-drop-earrings', 'Elegant rose gold drop earrings', 199.99, 25, 1, 1),
(3, 'Silver Hoop Earrings', 'silver-hoop-earrings', 'Timeless silver hoop earrings', 89.99, 45, 0, 0),
(3, 'Chandelier Earrings', 'chandelier-earrings', 'Gorgeous chandelier earrings', 499.99, 8, 1, 0),
(3, 'Cubic Zirconia Studs', 'cubic-zirconia-studs', 'Sparkling cubic zirconia studs', 59.99, 50, 0, 1),
(3, 'Tassel Earrings', 'tassel-earrings', 'Trendy tassel earrings', 49.99, 55, 1, 0),
(3, 'Rose Gold Hoop Earrings', 'rose-gold-hoop-earrings', 'Beautiful rose gold hoops', 149.99, 30, 0, 0),
(3, 'Emerald Drop Earrings', 'emerald-drop-earrings', 'Stunning emerald drop earrings', 699.99, 7, 1, 1),
(3, 'Huggie Hoop Earrings', 'huggie-hoop-earrings', 'Cute huggie hoop earrings', 119.99, 38, 0, 0),
(3, 'Amethyst Dangle Earrings', 'amethyst-dangle-earrings', 'Lovely amethyst dangle earrings', 249.99, 18, 1, 0),
(3, 'Gold Stud Earrings', 'gold-stud-earrings', 'Classic gold stud earrings', 179.99, 28, 0, 1),
(3, 'Moonstone Earrings', 'moonstone-earrings', 'Stunning moonstone drop earrings', 299.99, 16, 1, 0),
(3, 'Threader Earrings', 'threader-earrings', 'Trendy threader earrings', 109.99, 42, 0, 0),
(3, 'Sapphire Stud Earrings', 'sapphire-stud-earrings', 'Classic sapphire stud earrings', 599.99, 9, 1, 1),
(3, 'Feather Earrings', 'feather-earrings', 'Cute feather design earrings', 69.99, 48, 0, 0),
(3, 'Rose Gold Stud Earrings', 'rose-gold-stud-earrings', 'Elegant rose gold studs', 139.99, 32, 1, 0),
(3, 'Crystal Cluster Earrings', 'crystal-cluster-earrings', 'Sparkling crystal cluster earrings', 189.99, 22, 0, 1),
-- Bracelets (category_id=4) - 20 products
(4, 'Silver Charm Bracelet', 'silver-charm-bracelet', 'Beautiful silver bracelet with charms', 199.99, 25, 0, 0),
(4, 'Pink Crystal Bracelet', 'pink-crystal-bracelet', 'Sparkling pink crystal bracelet', 89.99, 35, 1, 0),
(4, 'Leather Wrap Bracelet', 'leather-wrap-bracelet', 'Stylish leather wrap bracelet with charms', 59.99, 30, 0, 0),
(4, 'Gold Bangle Bracelet', 'gold-bangle-bracelet', 'Classic gold bangle bracelet', 399.99, 12, 1, 1),
(4, 'Rose Gold Beaded Bracelet', 'rose-gold-beaded-bracelet', 'Beautiful beaded bracelet in rose gold', 149.99, 30, 0, 0),
(4, 'Silver Chain Bracelet', 'silver-chain-bracelet', 'Minimalist silver chain bracelet', 99.99, 40, 1, 0),
(4, 'Pearl Bracelet', 'pearl-bracelet', 'Elegant freshwater pearl bracelet', 249.99, 18, 0, 1),
(4, 'Cuff Bracelet', 'cuff-bracelet', 'Stylish metal cuff bracelet', 129.99, 28, 1, 0),
(4, 'Infinity Bracelet', 'infinity-bracelet', 'Elegant infinity symbol bracelet', 119.99, 35, 0, 0),
(4, 'Charm Bracelet Set', 'charm-bracelet-set', 'Cute set of 2 charm bracelets', 79.99, 45, 1, 1),
(4, 'Tennis Bracelet', 'tennis-bracelet', 'Classic cubic zirconia tennis bracelet', 299.99, 15, 0, 0),
(4, 'Rose Gold Chain Bracelet', 'rose-gold-chain-bracelet', 'Elegant rose gold chain bracelet', 169.99, 22, 1, 0),
(4, 'Beaded Stretch Bracelet', 'beaded-stretch-bracelet', 'Comfortable beaded stretch bracelet', 49.99, 50, 0, 1),
(4, 'Leather Bracelet', 'leather-bracelet', 'Stylish leather bracelet', 69.99, 42, 1, 0),
(4, 'Rose Gold Bangle Set', 'rose-gold-bangle-set', 'Set of 3 rose gold bangles', 229.99, 18, 0, 0),
(4, 'Silver Cuff Bracelet', 'silver-cuff-bracelet', 'Elegant silver cuff bracelet', 189.99, 24, 1, 1),
(4, 'Friendship Bracelet', 'friendship-bracelet', 'Cute friendship bracelet set', 39.99, 55, 0, 0),
(4, 'Rose Gold Charm Bracelet', 'rose-gold-charm-bracelet', 'Beautiful rose gold charm bracelet', 199.99, 20, 1, 0),
(4, 'Macrame Bracelet', 'macrame-bracelet', 'Trendy macrame bracelet', 59.99, 48, 0, 1),
(4, 'Crystal Charm Bracelet', 'crystal-charm-bracelet', 'Sparkling crystal charm bracelet', 149.99, 26, 1, 0),
-- Watches (category_id=5) - 20 products
(5, 'Luxury Watch', 'luxury-watch', 'Premium Swiss-made watch', 2999.99, 5, 1, 0),
(5, 'Pink Watch', 'pink-watch', 'Pretty pink leather strap watch', 199.99, 15, 1, 1),
(5, 'Silver Mesh Watch', 'silver-mesh-watch', 'Elegant silver mesh strap watch', 249.99, 18, 0, 0),
(5, 'Rose Gold Watch', 'rose-gold-watch', 'Beautiful rose gold watch', 299.99, 14, 1, 1),
(5, 'Classic Leather Watch', 'classic-leather-watch', 'Timeless classic leather watch', 179.99, 22, 0, 0),
(5, 'Mesh Bracelet Watch', 'mesh-bracelet-watch', 'Stylish mesh bracelet watch', 229.99, 16, 1, 0),
(5, 'Chronograph Watch', 'chronograph-watch', 'Sporty chronograph watch', 399.99, 10, 0, 1),
(5, 'White Dial Watch', 'white-dial-watch', 'Elegant white dial watch', 279.99, 15, 1, 0),
(5, 'Gold Watch', 'gold-watch', 'Classic gold watch', 499.99, 8, 0, 0),
(5, 'Stainless Steel Watch', 'stainless-steel-watch', 'Durable stainless steel watch', 349.99, 12, 1, 1),
(5, 'Blue Dial Watch', 'blue-dial-watch', 'Beautiful blue dial watch', 259.99, 17, 0, 0),
(5, 'Leather Strap Watch', 'leather-strap-watch', 'Comfortable leather strap watch', 189.99, 20, 1, 0),
(5, 'Rose Gold Mesh Watch', 'rose-gold-mesh-watch', 'Gorgeous rose gold mesh watch', 319.99, 13, 0, 1),
(5, 'Minimalist Watch', 'minimalist-watch', 'Simple and elegant minimalist watch', 219.99, 19, 1, 0),
(5, 'Black Watch', 'black-watch', 'Sleek black watch', 269.99, 14, 0, 0),
(5, 'Two-Tone Watch', 'two-tone-watch', 'Elegant two-tone gold and silver watch', 379.99, 9, 1, 1),
(5, 'Pink Leather Watch', 'pink-leather-watch', 'Pretty pink leather watch', 199.99, 16, 0, 0),
(5, 'Diamond Accent Watch', 'diamond-accent-watch', 'Elegant watch with diamond accents', 699.99, 6, 1, 0),
(5, 'Nylon Strap Watch', 'nylon-strap-watch', 'Sporty nylon strap watch', 159.99, 24, 0, 1),
(5, 'Rose Gold Dial Watch', 'rose-gold-dial-watch', 'Beautiful rose gold dial watch', 289.99, 13, 1, 0);
