<?php
session_start();
$isLogin = isset($_SESSION['shopkeeper_id']);
error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

if ($isLogin) {
} else {
    header("Location: ./login.php");
    exit;
}


if (strpos($_SERVER['REQUEST_URI'], 'shopkeeper') !== false) {
    $allowed_pages = ['dashboard.php', 'products.php', 'recent-orders.php'];
    if (!in_array(basename($_SERVER['PHP_SELF']), $allowed_pages)) {
        header("Location: ./404.php");
        exit;
    }
} else {
    header("Location: ./404.php");
}
