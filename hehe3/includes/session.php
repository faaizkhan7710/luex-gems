<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: ../login.php');
        exit;
    }
}
?>