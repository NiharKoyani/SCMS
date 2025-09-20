<?php
session_start();

if (isset($_SESSION['shopkeeper_id'])) {
    include('./shopkeeper/index.php');
} else {
    header('location: ./home.php');
}
?>