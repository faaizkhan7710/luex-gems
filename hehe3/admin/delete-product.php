<?php
require_once '../includes/auth.php';
requireAdminLogin();

$id = cleanInput($_GET['id']);
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

redirect('products.php');
?>