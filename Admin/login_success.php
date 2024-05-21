<?php
session_start();

// Your login validation code here
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "unitenadmin"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . htmlspecialchars($conn->connect_error));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("SELECT Password FROM admindatabase WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username exists, fetch the hashed password
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($pass, $hashed_password)) {
            // Start secure session
            session_regenerate_id(); // Regenerate session ID for security
            $_SESSION['email'] = $email;

            // Redirect to the desired page
            header("Location: Admin_Dashboard.php");
            exit();
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "Invalid email or password!";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

// If login is successful, set session variables
$_SESSION['email'] = $email;

// Redirect to the desired page
header("Location: Admin_Dashboard.php");
exit();
