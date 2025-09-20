<?php
session_start();

error_reporting(E_ALL);        // Report all errors
ini_set("display_errors", 1);

if (isset($_SESSION['shopkeeper_id'])) {
    include('dashboard.php');
} else {
    header('location: ./login.php');
}
?>