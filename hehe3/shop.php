<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$category_slug = isset($_GET['category']) ? $_GET['category'] : null;
$search_query = isset($_GET['search']) ? trim($_GET['search']) : null;
$category_name = null;
$page_title = "Shop All Pretty Things";

if ($category_slug) {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
    $stmt->execute([$category_slug]);
    $category = $stmt->fetch();
    $category_name = $category ? $category['name'] : null;
    $page_title = "Shop " . htmlspecialchars($category_name);
    
    $stmt = $pdo->prepare("SELECT p.* FROM products p JOIN categories c ON p.category_id = c.id WHERE c.slug = ?");
    $stmt->execute([$category_slug]);
} elseif ($search_query) {
    $page_title = "Search Results for \"" . htmlspecialchars($search_query) . "\"";
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ?");
    $search_term = "%$search_query%";
    $stmt->execute([$search_term, $search_term]);
} else {
    $stmt = $pdo->query("SELECT * FROM products");
}
$products = $stmt->fetchAll();
?>

<section class="shop-section">
    <div class="container">
        <h1 class="shop-title fw-bold">
            <?php if ($category_name): ?>
                ✨ Shop <?php echo htmlspecialchars($category_name); ?> ✨
            <?php else: ?>
                ✨ Shop All Pretty Things ✨
            <?php endif; ?>
        </h1>
        <div class="row g-4">
            <?php foreach($products as $product): ?>
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

<?php
require_once 'includes/footer.php';
?>