<?php
session_start();
include 'products.php';

$id = $_POST['id'] ?? 0;
if ($id) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $id;
}

header('Location: cart.php');
?>