<?php
require_once '../includes/auth.php';
requireAdminLogin();

$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_orders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_sales = $pdo->query("SELECT COALESCE(SUM(total), 0) FROM orders WHERE status = 'completed'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LuxeGems Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">LuxeGems Admin</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                    <li class="nav-item"><a class="nav-link" href="customers.php">Customers</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container py-5">
        <h1 class="fw-bold mb-5">Dashboard</h1>
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card shadow text-center p-4">
                    <h3 class="fw-bold text-primary"><?php echo $total_products; ?></h3>
                    <p>Total Products</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center p-4">
                    <h3 class="fw-bold text-success"><?php echo $total_orders; ?></h3>
                    <p>Total Orders</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center p-4">
                    <h3 class="fw-bold text-info"><?php echo $total_users; ?></h3>
                    <p>Total Customers</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow text-center p-4">
                    <h3 class="fw-bold text-warning">$<?php echo number_format($total_sales, 2); ?></h3>
                    <p>Total Sales</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>