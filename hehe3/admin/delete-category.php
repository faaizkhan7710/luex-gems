<?php
require_once '../includes/auth.php';
requireAdminLogin();

$id = cleanInput($_GET['id']);
$stmt = $pdo->prepare("DELETE FROM categories WHERE id = ?");
$stmt->execute([$id]);

redirect('categories.php');
?>