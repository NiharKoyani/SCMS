<?php
error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

session_start();
$currentUser = $_SESSION['shopkeeper_id'];


include('../../Utility/db.php');

if (isset($_GET['remove'])) {
    $Id = $_GET['remove'];
    $sql = "DELETE FROM cart_items WHERE shopkeeper_id=$currentUser AND product_id=$Id";
    $result = $conn->query($sql);
}
header("Location: ../cart.php");
exit();
?>