<?php
// update-my-shop.php

// Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'scms';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
$required = ['shop_id', 'shop_name', 'address', 'phone', 'email'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing field: $field"]);
        exit;
    }
}

// Prepare and execute update
$stmt = $conn->prepare("UPDATE shopkeeper SET shop_name=?, shop_location=?, mobile_number=?, email=? WHERE id=?");
$stmt->bind_param(
    "ssssi",
    $data['shop_name'],
    $data['address'],
    $data['phone'],
    $data['email'],
    $data['shop_id']
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Update failed']);
}

$stmt->close();
$conn->close();
