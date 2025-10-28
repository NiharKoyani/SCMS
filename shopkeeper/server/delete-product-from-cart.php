<?php
error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

session_start();
if (!isset($_SESSION['shopkeeper_id'])) {
    // Redirect to login page or show an error message
    header('Location: ../../auth/login.php');
    exit();
}
$currentUser = $_SESSION['shopkeeper_id'];


include('../../Utility/db.php');

if (isset($_GET['remove'])) {
    $Id = $_GET['remove'];
    $sql = "DELETE FROM cart_items WHERE shopkeeper_id=$currentUser AND product_id=$Id";
    $result = $conn->query($sql);
}
header("Location: ../pages/cart.php");
exit();
?>