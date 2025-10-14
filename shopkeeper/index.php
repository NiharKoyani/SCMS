<?php
session_start();
$isLogin = isset($_SESSION['shopkeeper_id']);
error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

if (!$isLogin) {
    header('Location: ../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Shopkeeper Dashboard</title>
</head>

<body>
    <?php header('Location: ./pages/dashboard.php') ?>
</body>

</html>