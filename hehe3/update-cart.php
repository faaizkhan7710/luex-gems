<?php
require_once 'includes/auth.php';
requireLogin();

$id = cleanInput($_GET['id']);
$action = cleanInput($_GET['action']);

if ($action == 'increase') {
    $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $_SESSION['user_id']]);
} elseif ($action == 'decrease') {
    $stmt = $pdo->prepare("UPDATE cart SET quantity = quantity - 1 WHERE id = ? AND user_id = ? AND quantity > 1");
    $stmt->execute([$id, $_SESSION['user_id']]);
}

redirect('cart.php');
?>