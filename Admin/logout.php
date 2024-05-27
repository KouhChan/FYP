<?php
session_start();


$_SESSION = array();

// Delete the session
session_destroy();

// Redirect to the login page
header("Location: AdminLogin.php");
exit();
