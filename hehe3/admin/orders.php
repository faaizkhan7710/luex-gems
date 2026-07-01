<?php
require_once '../includes/auth.php';
requireAdminLogin();

$stmt = $pdo->query("SELECT o.*, u.name as user_name FROM orders o LEFT JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC");
$orders = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = cleanInput($_POST['order_id']);
    $status = cleanInput($_POST['status']);
    
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);
    
    redirect('orders.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - LuxeGems Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">LuxeGems Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
                    <li class="nav-item"><a class="nav-link active" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="customers.php">Customers</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container py-5">
        <h1 class="fw-bold mb-5">Orders</h1>
        
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?php echo $order['id']; ?></td>
                            <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td><?php echo formatPrice($order['total']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $order['status'] == 'completed' ? 'success' : ($order['status'] == 'pending' ? 'warning' : 'secondary'); ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($order['created_at'])); ?></td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                        <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                        <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>