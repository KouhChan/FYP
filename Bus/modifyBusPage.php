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

// Check if Bus ID is provided in the query parameter
if (isset($_GET['bus_id'])) {
    // Retrieve Bus ID from the query parameter
    $busID = $_GET['bus_id'];

    // SQL query to fetch bus information for the given Bus ID
    $sql = "SELECT * FROM bus_info WHERE BUS_ID = $busID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch bus information
        $row = $result->fetch_assoc();
        $busPlat = $row['Plat_No'];
        $personIncharge = $row['Person_Incharge'];
        $dateCreated = $row['Date_Created'];
    } else {
        echo "No bus found with Bus ID: $busID";
    }
} else {
    echo "Bus ID not provided in the query parameter.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Bus Information</title>
</head>

<body>
    <h1>Modify Bus Information</h1>
    <form action="modifyBusInfo.php" method="POST">
        <input type="hidden" name="busID" value="<?php echo $busID; ?>"> <!-- Hidden input field to pass bus ID -->
        <label for="busPlat">Plat Number:</label><br>
        <input type="text" id="busPlat" name="busPlat" value="<?php echo $row['Plat_No']; ?>"><br> <!-- Pre-fill Plat Number field -->
        <label for="personIncharge">Person Incharge:</label><br>
        <input type="text" id="personIncharge" name="personIncharge" value="<?php echo $row['Person_Incharge']; ?>"><br> <!-- Pre-fill Person Incharge field -->
        <input type="submit" value="Modify">
    </form>
</body>

</html>