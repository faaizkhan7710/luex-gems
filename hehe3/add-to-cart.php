<?php
require_once 'includes/auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = cleanInput($_POST['product_id']);
    $quantity = cleanInput($_POST['quantity']);
    
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$quantity, $user_id, $product_id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $quantity]);
    }
    
    redirect('cart.php');
}
redirect('shop.php');
?>