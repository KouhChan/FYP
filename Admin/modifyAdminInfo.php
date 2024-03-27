<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "admin"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ID = $_POST["ID"];
    $username = $_POST["Username"];
    $password = $_POST["Password"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("UPDATE credential SET ID=?, username=? WHERE password =?");
    $stmt->bind_param("iss", $ID, $username, $password);

    // Execute statement
    if ($stmt->execute()) {
        echo "Admin information updated successfully!";
        header("Location: View_Admin.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
