<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "unitenadmin";

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
    $adminID = $_POST["Admin_ID"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("UPDATE admindatabase SET Admin_ID=?, Name=?, Email=?, Password=? WHERE ID=?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ssssi", $adminID, $name, $email, $hashed_password, $ID);

    // Execute statement
    if ($stmt->execute()) {
        echo "Admin information updated successfully!";
        header("Location: viewAdmin.php");
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
