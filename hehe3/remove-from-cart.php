<?php
require_once 'includes/auth.php';
requireLogin();

$id = cleanInput($_GET['id']);
$stmt = $pdo->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

redirect('cart.php');
?>