<?php
$id = $_POST['Pid'];
$shopkeeper_id = $_POST['shopkeeper_id'];
$quantity = $_POST['quantity'];

$conn = new mysqli('localhost', 'root', '', 'scms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

header("Location: ../cart.php");
exit();
?>