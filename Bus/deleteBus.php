<?php
// Check if bus ID is set and not empty
if (isset($_GET['bus_id']) && !empty($_GET['bus_id'])) {
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

    // Prepare and bind the DELETE statement
    $sql = "DELETE FROM bus_info WHERE Bus_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bus_id); // "i" indicates the type of parameter (integer)

    // Set parameters and execute the statement
    $bus_id = $_GET['bus_id'];
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Bus information deleted successfully.";
        header("Location: View_Bus.php");
    } else {
        echo "Error deleting bus information.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid bus ID.";
}
