<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$database = "unitenadmin"; // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the next available Admin ID from the database
$sql = "SELECT MAX(CAST(SUBSTRING(Admin_ID, 3) AS UNSIGNED)) AS max_id FROM admindatabase";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $next_id = $row["max_id"] + 1;
    $admin_id = "AD" . sprintf("%03d", $next_id); // Format the next ID
} else {
    $admin_id = "AD001"; // If no records exist, start with AD001
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST["ID"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["pass"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO admindatabase (ID, Admin_ID, Name, Email, Password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id, $admin_id, $name, $email, $hashed_password); // Admin ID from database, not user input

    // Execute statement
    if ($stmt->execute()) {
        header("Location: viewAdmin.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin Page</title>
</head>

<body>
    <div class="col-md-3 form-container d-flex align-items-center">
        <form action="addAdmin.php" method="post">
            <div class="mb-3">
                <img src="Img/Uni10.jpg" style="margin: auto">
                <h4>Admin Login</h4>
                <h5>Insert Admin To Register</h5>
                <input name="ID" type="hidden" value="<?php echo htmlspecialchars($next_id); ?>">
                <label class="form-label" style="font-weight: bold;">Admin ID: <?php echo $admin_id; ?></label>
                <input name="name" type="name" class="form-control" placeholder="Name" required> <br>
                <label for="textEmail" class="form-label" style="font-weight: bold;">Email Address</label>
                <input name="email" type="email" class="form-control" placeholder="Email Address" required> <br>
                <input name="pass" type="password" class="form-control" placeholder="Password" required><br>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</body>

</html>