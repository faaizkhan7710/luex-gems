<?php
require_once 'includes/auth.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT w.*, p.name, p.price, p.slug FROM wishlist w JOIN products p ON w.product_id = p.id WHERE w.user_id = ?");
$stmt->execute([$user_id]);
$wishlist_items = $stmt->fetchAll();

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">Wishlist</h1>
        <?php if (empty($wishlist_items)): ?>
            <div class="text-center py-5">
                <h3>Your wishlist is empty</h3>
                <a href="shop.php" class="btn btn-primary mt-3">Browse Products</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($wishlist_items as $item): ?>
                <div class="col-md-3">
                    <div class="product-card p-4 text-center">
                        <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=<?php echo urlencode("cute sparkly pink pastel jewelry " . $item['name']); ?>&image_size=square" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-fluid mb-3 rounded">
                        <h5 class="fw-bold" style="color: #D65B88;"><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p class="fw-bold" style="color: #FF69B4;"><?php echo formatPrice($item['price']); ?></p>
                        <a href="product.php?slug=<?php echo $item['slug']; ?>" class="btn btn-sm btn-primary">View Product</a>
                        <a href="remove-from-wishlist.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-danger ms-2">Remove</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>