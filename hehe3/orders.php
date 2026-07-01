<?php
require_once 'includes/auth.php';
requireLogin();

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">My Orders</h1>
        <?php if (empty($orders)): ?>
            <div class="text-center py-5">
                <h3>No orders yet</h3>
                <a href="shop.php" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($orders as $order): ?>
                <div class="col-md-12 mb-4">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Order #<?php echo $order['id']; ?></span>
                            <span class="badge bg-primary"><?php echo ucfirst($order['status']); ?></span>
                        </div>
                        <div class="card-body">
                            <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>
                            <p><strong>Total:</strong> <?php echo formatPrice($order['total']); ?></p>
                            <p><strong>Payment Method:</strong> <?php echo ucfirst($order['payment_method']); ?></p>
                        </div>
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