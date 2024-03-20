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

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("UPDATE bus_info SET Plat_No=?, Person_Incharge=? WHERE BUS_ID=?");
    $stmt->bind_param("ssi", $busPlat, $personIncharge, $busID);

    // Execute statement
    if ($stmt->execute()) {
        echo "Bus information updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
