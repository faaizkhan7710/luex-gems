<?php
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function formatPrice($price) {
    return '$' . number_format($price, 2);
}

function redirect($url) {
    header("Location: $url");
    exit;
}
?>