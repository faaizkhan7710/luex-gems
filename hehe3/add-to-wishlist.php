<?php
require_once 'includes/auth.php';
requireLogin();

$product_id = cleanInput($_GET['product_id']);
$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $product_id]);
} catch (PDOException $e) {
}

redirect('wishlist.php');
?>