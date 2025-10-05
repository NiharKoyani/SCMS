<?php
session_start();
$isLogin = isset($_SESSION['shopkeeper_id']);
error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>
    <?php
        if ($isLogin) {
        } else {
            include('../login.php');
            exit;
        }
    ?>
</body>
</html>