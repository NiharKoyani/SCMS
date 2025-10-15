<?php
session_start();
$isLogin = isset($_SESSION['admin_id']);

if (!$isLogin) {
    header('Location: ../../auth/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Admin Dashboard</title>
</head>

<body>
    <?php header('Location: ../dashboard.php') ?>
</body>

</html>