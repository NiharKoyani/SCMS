<?php
// update-my-shop.php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
// Database connection
require_once('../../Utility/db.php');

$shop_name = $_POST['shop_name'];
$shop_location = $_POST['shop_location'];
$mobile_number = $_POST['mobile_number'];
$email = $_POST['email'];
$shop_id = $_SESSION['shopkeeper_id'];

// Prepare and execute update
$stmt = $conn->prepare("UPDATE shopkeeper SET shop_name=?, shop_location=?, mobile_number=?, email=? WHERE id=?");
$stmt->bind_param(
    "ssssi",
    $shop_name,
    $shop_location,
    $mobile_number,
    $email,
    $shop_id,
);

if ($stmt->execute()) {
    $_SESSION['my-shop'] = 'Profile updated successfully!';
    header('Location: ../pages/my-shop.php');
} else {
    echo json_encode(['error' => 'Update failed']);
}

$stmt->close();
$conn->close();
