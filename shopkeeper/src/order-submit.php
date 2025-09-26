<?php
session_start();
$currentUser = $_SESSION['shopkeeper_id'];
?>
<?php
error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

// Include database connection
include('../../Utility/db.php');

$categoryCode = $_POST['categoryCode'];

$sql = "SELECT * FROM cart_items WHERE shopkeeper_id=$currentUser";
$result = $conn->query($sql);

$stmt = $conn->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'orders'");
$stmt->execute();
$result_auto = $stmt->get_result();
$next_id_info = null;
if ($result_auto && $row_auto = $result_auto->fetch_assoc()) {
    $next_id_info = $row_auto['AUTO_INCREMENT'];
}
foreach ($result as $row) {
    $productId = $row['product_id'];
    $uIdCode = $currentUser . $categoryCode . $next_id_info;

    $sql = "INSERT INTO orders (orderId, shopkeeper_id, product_id, quantity, status) VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $uIdCode, $row['shopkeeper_id'], $row['product_id'], $row['quantity']);

    if ($stmt->execute()) {
        echo "Order place successfully." . $next_id_info;
        $Id = $row['product_id'];
        $sql = "DELETE FROM cart_items WHERE shopkeeper_id=$currentUser AND product_id=$Id";
        $result = $conn->query($sql);
    } else {
        echo "Error Ordering : " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

header("Location: ../cart.php");
exit();
