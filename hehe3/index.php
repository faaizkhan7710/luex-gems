<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$stmt = $pdo->query("SELECT * FROM products WHERE is_featured = 1 LIMIT 8");
$featured_products = $stmt->fetchAll();

$stmt = $pdo->query("SELECT * FROM products WHERE is_bestseller = 1 LIMIT 8");
$bestsellers = $stmt->fetchAll();
?>

<section class="hero-section">
    <span class="hero-flower-1">🌸</span>
    <span class="hero-flower-2">🌷</span>
    <span class="hero-sparkle">✨</span>
    <span class="hero-sparkle-2">💫</span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4" style="color: #D65B88;">✨ Discover Sparkling Beauty ✨</h1>
                <p class="lead mb-4" style="color: #8B5A7E;">Pretty jewelry for your pretty self 🌸 Get ready to sparkle and shine! 💎</p>
                <a href="shop.php" class="btn btn-primary btn-lg">Shop Now 🛍️</a>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=cute%20pink%20pastel%20jewelry%20display%20sparkly%20rings%20necklaces%20with%20flowers%20aesthetic&image_size=landscape_16_9" alt="Luxe Jewelry" class="img-fluid rounded-3 shadow-lg" style="border: 4px solid #FFB6C1;">
            </div>
        </div>
    </div>
</section>

<section class="featured-collection">
    <div class="container">
        <h2 class="section-title fw-bold">Featured Collections</h2>
        <div class="row g-4">
            <?php foreach($featured_products as $product): ?>
            <div class="col-md-3" data-aos="fade-up">
                <div class="product-card p-4 text-center">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=<?php echo urlencode("cute sparkly pink pastel jewelry " . $product['name']); ?>&image_size=square" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid mb-3 rounded">
                    <h5 class="fw-bold" style="color: #D65B88;"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="fw-bold" style="color: #FF69B4;"><?php echo formatPrice($product['price']); ?></p>
                    <a href="product.php?slug=<?php echo $product['slug']; ?>" class="btn btn-sm btn-primary">View Details 💕</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="featured-collection" style="background-color: #FFE6F2;">
    <div class="container">
        <h2 class="section-title fw-bold">Best Sellers</h2>
        <div class="row g-4">
            <?php foreach($bestsellers as $product): ?>
            <div class="col-md-3" data-aos="fade-up">
                <div class="product-card p-4 text-center">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=<?php echo urlencode("cute sparkly pink pastel jewelry " . $product['name']); ?>&image_size=square" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid mb-3 rounded">
                    <h5 class="fw-bold" style="color: #D65B88;"><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="fw-bold" style="color: #FF69B4;"><?php echo formatPrice($product['price']); ?></p>
                    <a href="product.php?slug=<?php echo $product['slug']; ?>" class="btn btn-sm btn-primary">View Details 💕</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Banner Section -->
<section class="featured-collection" style="background: linear-gradient(135deg, #FFE6F2 0%, #FFD1E6 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right">
                <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=cute%20pink%20pastel%20jewelry%20flat%20lay%20aesthetic%20with%20flowers&image_size=square" alt="Special Offer" class="img-fluid rounded-3 shadow-lg" style="border: 4px solid #FFB6C1;">
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h2 class="fw-bold mb-4" style="color: #D65B88;">✨ Limited Time Offer ✨</h2>
                <p class="lead mb-4" style="color: #8B5A7E;">Get 20% off all pink-themed jewelry this week! Use code PINKLOVE at checkout!</p>
                <a href="shop.php" class="btn btn-primary btn-lg">Shop Sale 🎉</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="featured-collection">
    <div class="container">
        <h2 class="section-title fw-bold">Why Choose Us</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card text-center p-4" style="border-radius: 25px; border: 2px solid #FFB6C1; background: white;">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=cute%20pink%20gift%20box%20aesthetic&image_size=square" alt="Free Shipping" class="img-fluid mb-3 rounded" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="fw-bold mb-2" style="color: #D65B88;">Free Shipping</h5>
                    <p style="color: #8B5A7E;">On all orders over $50</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card text-center p-4" style="border-radius: 25px; border: 2px solid #FFB6C1; background: white;">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=cute%20pink%20warranty%20badge%20aesthetic&image_size=square" alt="Quality Guarantee" class="img-fluid mb-3 rounded" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="fw-bold mb-2" style="color: #D65B88;">Quality Guarantee</h5>
                    <p style="color: #8B5A7E;">Premium materials only</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card text-center p-4" style="border-radius: 25px; border: 2px solid #FFB6C1; background: white;">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=cute%20pink%20customer%20service%20aesthetic&image_size=square" alt="Great Support" class="img-fluid mb-3 rounded" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="fw-bold mb-2" style="color: #D65B88;">Great Support</h5>
                    <p style="color: #8B5A7E;">We're here to help 24/7</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>