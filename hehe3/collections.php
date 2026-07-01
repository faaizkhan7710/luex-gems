<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<section class="collections-section">
    <div class="container">
        <h1 class="collections-title fw-bold">🌸 Our Pretty Collections 🌸</h1>
        <div class="row g-4">
            <?php foreach($categories as $category): ?>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card collection-card text-center p-4">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=cute%20pink%20pastel%20jewelry%20collection%20<?php echo urlencode($category['name']); ?>&image_size=square" alt="<?php echo htmlspecialchars($category['name']); ?>" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h3 class="fw-bold mb-2" style="color: #D65B88;"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p class="mb-3" style="color: #8B5A7E;"><?php echo htmlspecialchars($category['description']); ?></p>
                    <a href="shop.php?category=<?php echo $category['slug']; ?>" class="btn btn-primary">Shop Now 🛍️</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>