<?php
require_once '../includes/auth.php';
requireAdminLogin();

$id = cleanInput($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    redirect('products.php');
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = cleanInput($_POST['category_id']);
    $name = cleanInput($_POST['name']);
    $slug = cleanInput($_POST['slug']);
    $description = cleanInput($_POST['description']);
    $price = cleanInput($_POST['price']);
    $stock = cleanInput($_POST['stock']);
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $is_bestseller = isset($_POST['is_bestseller']) ? 1 : 0;
    
    $stmt = $pdo->prepare("UPDATE products SET category_id = ?, name = ?, slug = ?, description = ?, price = ?, stock = ?, is_featured = ?, is_bestseller = ? WHERE id = ?");
    $stmt->execute([$category_id, $name, $slug, $description, $price, $stock, $is_featured, $is_bestseller, $id]);
    
    redirect('products.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - LuxeGems Admin</title>
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
        <h1 class="fw-bold mb-5">Edit Product</h1>
        
        <div class="card shadow">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo $product['category_id'] == $category['id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="<?php echo htmlspecialchars($product['slug']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" value="<?php echo $product['stock']; ?>" required>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="featured" <?php echo $product['is_featured'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="featured">Featured Product</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_bestseller" class="form-check-input" id="bestseller" <?php echo $product['is_bestseller'] ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="bestseller">Best Seller</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>