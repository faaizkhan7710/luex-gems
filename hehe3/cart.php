<?php
require_once 'includes/auth.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT c.*, p.name, p.price, p.slug FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">Shopping Cart</h1>
        <?php if (empty($cart_items)): ?>
            <div class="text-center py-5">
                <h3>Your cart is empty</h3>
                <a href="shop.php" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <?php foreach ($cart_items as $item): ?>
                    <div class="card mb-3">
                        <div class="card-body d-flex align-items-center">
                            <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=<?php echo urlencode("elegant premium quality jewelry product photo " . $item['name']); ?>&image_size=square" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-thumbnail" style="width: 100px;">
                            <div class="ms-3 flex-grow-1">
                                <h5 class="fw-bold"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="text-primary fw-bold"><?php echo formatPrice($item['price']); ?></p>
                            </div>
                            <div class="text-center">
                                <a href="update-cart.php?id=<?php echo $item['id']; ?>&action=decrease" class="btn btn-sm btn-outline-secondary">-</a>
                                <span class="mx-2"><?php echo $item['quantity']; ?></span>
                                <a href="update-cart.php?id=<?php echo $item['id']; ?>&action=increase" class="btn btn-sm btn-outline-secondary">+</a>
                            </div>
                            <a href="remove-from-cart.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger ms-3">Remove</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4">Order Summary</h4>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span class="fw-bold"><?php echo formatPrice($total); ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Total</span>
                                <span class="fw-bold text-primary fs-4"><?php echo formatPrice($total); ?></span>
                            </div>
                            <a href="checkout.php" class="btn btn-primary w-100 btn-lg">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>