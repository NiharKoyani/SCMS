<?php
session_start();


if (isset($_GET['login'])) {
    header('Location: ./auth/login.php');
} elseif (isset($_GET['registration'])) {
    header('Location: ./auth/registration.php');
} elseif (isset($_GET['forgot-password'])) {
    header('Location: ./auth/forgot-password.php');
} else {
    include 'home.php';
}
