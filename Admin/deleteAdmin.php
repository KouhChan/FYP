<?php
// Check if bus ID is set and not empty
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
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
    $sql = "DELETE FROM credential WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID); // "i" indicates the type of parameter (integer)

    // Set parameters and execute the statement
    $ID = $_GET['ID'];
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Admin information deleted successfully.";
        header("Location: View_Admin.php");
    } else {
        echo "Error deleting Admin information.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid bus ID.";
}
