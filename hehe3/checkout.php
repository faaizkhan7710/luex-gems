<?php
require_once 'includes/auth.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT c.*, p.name, p.price FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll();

if (empty($cart_items)) {
    redirect('cart.php');
}

$total = 0;
foreach ($cart_items as $item) {
    $total += $item['price'] * $item['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shipping_address = cleanInput($_POST['shipping_address']);
    $payment_method = cleanInput($_POST['payment_method']);
    
    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, status, payment_method, shipping_address) VALUES (?, ?, 'pending', ?, ?)");
        $stmt->execute([$user_id, $total, $payment_method, $shipping_address]);
        $order_id = $pdo->lastInsertId();
        
        foreach ($cart_items as $item) {
            $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
        }
        
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$user_id]);
        
        $pdo->commit();
        redirect('orders.php');
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Order failed. Please try again.";
    }
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">Checkout</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-8">
                <form method="POST">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Shipping Address</h5>
                            <div class="mb-3">
                                <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Enter your full shipping address"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Payment Method</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                                <label class="form-check-label" for="cod">Cash on Delivery</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="stripe" id="stripe">
                                <label class="form-check-label" for="stripe">Stripe</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" value="paypal" id="paypal">
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                </form>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Order Summary</h4>
                        <?php foreach ($cart_items as $item): ?>
                        <div class="d-flex justify-content-between mb-2">
                            <span><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['quantity']; ?></span>
                            <span><?php echo formatPrice($item['price'] * $item['quantity']); ?></span>
                        </div>
                        <?php endforeach; ?>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total</span>
                            <span class="fw-bold text-primary fs-4"><?php echo formatPrice($total); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>