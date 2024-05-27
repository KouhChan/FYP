<?php
// Check if bus ID is set and not empty
if (isset($_GET['ID']) && !empty($_GET['ID'])) {
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

    //the DELETE statement
    $sql = "DELETE FROM admindatabase WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);


    $ID = $_GET['ID'];
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Admin information deleted successfully.";
        header("Location: viewAdmin.php");
    } else {
        echo "Error deleting Admin information.";
    }


    $stmt->close();
    $conn->close();
} else {
    echo "Invalid Admin ID.";
}
