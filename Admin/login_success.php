<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "unitenadmin";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Received a POST request
    $email = $_POST["email"];
    $pass = $_POST["pass"];


    $stmt = $conn->prepare("SELECT Email, Password FROM admindatabase WHERE BINARY Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        $stmt->bind_result($db_email, $hashed_password);
        $stmt->fetch();

        // Verify  email same with database
        if ($email === $db_email && password_verify($pass, $hashed_password)) {
            // Start secure session
            session_regenerate_id(true); // Regenerate session ID for security
            $_SESSION['email'] = $email;


            header("Location: Admin_Dashboard.php");
            exit();
        } else {
            $error_message = "Invalid email or password!";
        }
    } else {
        $error_message = "Invalid email or password!";
    }


    $stmt->close();
    $conn->close();


    echo "<script>alert('$error_message'); window.location.href = 'AdminLogin.php';</script>";
    exit();
}
