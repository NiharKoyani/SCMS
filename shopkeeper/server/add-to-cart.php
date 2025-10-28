<?php
session_start();

error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);


if (!isset($_SESSION['shopkeeper_id'])) {
    // Redirect to login page or show an error message
    header('Location: ../../auth/login.php');
    exit();
}

$shopkeeperId = $_SESSION['shopkeeper_id'];
$productId = $_POST['id'];
$userQuantity = $_POST['quantity'];
$categoryCode = $_POST['categoryCode'];


include('../../Utility/db.php');

// Check if the cart item already exists for this shopkeeper and product
$sql = "SELECT quantity FROM cart_items WHERE shopkeeper_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $shopkeeperId, $productId);
$stmt->execute();

$stmt->store_result();
if ($stmt->num_rows > 0) {
    // Item exists, update quantity
    $stmt->bind_result($quantity);
    $stmt->fetch();
    $newQuantity = $quantity + $userQuantity;

    $updateSql = "UPDATE cart_items SET quantity = ? WHERE shopkeeper_id = ? AND product_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iii", $newQuantity, $shopkeeperId, $productId);
    $updateStmt->execute();
    $updateStmt->close();

    $stmt->close();
    $conn->close();
    header('Location: ../pages/cart.php');
    exit;
}
$stmt->close();

$sql = "INSERT INTO cart_items (shopkeeper_id, product_id, quantity, categoryCode) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiis", $shopkeeperId, $productId, $userQuantity, $categoryCode);

if ($stmt->execute()) {
    header('Location: ../pages/cart.php');
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
