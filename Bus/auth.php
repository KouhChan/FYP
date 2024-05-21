<?php
session_start();

if (!isset($_SESSION['email'])) {
    // User is not logged in, redirect to login page
    header("Location: ../Admin/AdminLogin.php");
    exit();
}
