<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

if (!isset($_SESSION['shopkeeper_id'])) {
    // Redirect to login page or show an error message
    header('Location: ../../auth/login.php');
    exit();
}

$id = $_POST['productId'];
$shopkeeper_id = $_POST['shopkeeper_id'];
$quantity = $_POST['quantity'];

include('../../Utility/db.php');

$sql = "UPDATE cart_items SET quantity = ? WHERE shopkeeper_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $quantity, $shopkeeper_id, $id);

if ($stmt->execute()) {
    echo "Cart updated successfully.";
} else {
    echo "Error updating cart: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: ../pages/cart.php");
exit();
