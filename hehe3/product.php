<?php
require_once 'includes/auth.php';

if (!isset($_GET['slug'])) {
    redirect('shop.php');
}

$slug = cleanInput($_GET['slug']);
$stmt = $pdo->prepare("SELECT * FROM products WHERE slug = ?");
$stmt->execute([$slug]);
$product = $stmt->fetch();

if (!$product) {
    redirect('shop.php');
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=<?php echo urlencode("elegant premium quality jewelry product photo " . $product['name']); ?>&image_size=square_hd" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid rounded-3 shadow-lg">
            </div>
            <div class="col-md-6">
                <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="fs-3 text-primary fw-bold mb-4"><?php echo formatPrice($product['price']); ?></p>
                <p class="mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
                <form action="add-to-cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>" class="form-control" style="max-width: 100px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
                    <a href="add-to-wishlist.php?product_id=<?php echo $product['id']; ?>" class="btn btn-outline-secondary btn-lg ms-2">Add to Wishlist</a>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>