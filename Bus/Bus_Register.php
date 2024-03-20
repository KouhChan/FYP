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
    $busID = $_POST["busID"];
    $busPlat = $_POST["busPlat"];
    $personIncharge = $_POST["personIncharge"];
    $Date = date('Y-m-d', strtotime($_POST["dateInput"]));

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO bus_info (BUS_ID, Plat_No, Person_Incharge, Date_Created) VALUES (NULL, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $success = $stmt->bind_param("sss", $busPlat, $personIncharge, $Date);

    // Check for errors in binding parameters
    if (!$success) {
        die("Error binding parameters: " . $stmt->error);
    }

    // Execute statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
