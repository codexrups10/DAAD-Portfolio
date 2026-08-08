<?php
session_start();
$id = $_GET['id'] ?? 0;
if ($id && isset($_SESSION['cart'])) {
    $key = array_search($id, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex
    }
}
header('Location: cart.php');
?>