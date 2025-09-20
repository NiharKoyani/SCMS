<?php

error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

include('../../Utility/db.php');
session_start();

// Process form data when form is submitted
if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate and sanitize input data
        $shopName = htmlspecialchars(trim($_POST['shopName']));
        $ownerName = htmlspecialchars(trim($_POST['ownerName']));
        $mobile = htmlspecialchars(trim($_POST['mobile']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);
        $shopAddress = htmlspecialchars(trim($_POST['shopAddress']));

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format");
        }

        // Check if passwords match (client-side should handle this, but double-check)
        if ($_POST['password'] !== $_POST['confirmPassword']) {
            die("Passwords do not match");
        }

        // Check if terms were accepted
        if (!isset($_POST['terms'])) {
            die("You must accept the terms and conditions");
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email or mobile already exists
        $checkStmt = $conn->prepare("SELECT email, mobile_number FROM shopkeeper WHERE email = ? OR mobile_number = ?");
        $checkStmt->bind_param("ss", $email, $mobile);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // Fetch existing values
            $checkStmt->bind_result($existingEmail, $existingMobile);
            $checkStmt->fetch();

            if ($existingEmail === $email) {
                $_SESSION['registration_error'] = "This e-mail is already registered.";
            }
            if ($existingMobile === $mobile) {
                $_SESSION['registration_error_phoneNumber'] = "This mobile number is already registered.";
            }
            header("Location: ../registration.php");
            exit();
        }
        $checkStmt->close();

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO shopkeeper (shop_name, owner_name, mobile_number, email, password, shop_location, created_at, Status) VALUES (?, ?, ?, ?, ?, ?, NOW(),0)");
        $stmt->bind_param("ssssss", $shopName, $ownerName, $mobile, $email, $hashedPassword, $shopAddress);

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful - redirect to success page
            header("Location: ../registration_sucess.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    // Close statement
    $stmt->close();
} else if (isset($_POST['login'])) {

    // Process login
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Prepare statement to fetch user
    $stmt = $conn->prepare("SELECT id, password FROM shopkeeper WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($userId, $hashedPassword);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            // Login successful
            $_SESSION['shopkeeper_id'] = $userId;
            header("Location: ../dashboard.php?dashboard");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid password.";
            header("Location: ./login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "No user found with this email.";
        header("Location: ./login.php");
        exit();
    }
    $stmt->close();
}

// Close connection
$conn->close();

?>
<form action=""></form>