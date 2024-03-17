<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        function togglePasswords() {
            var passwords = document.querySelectorAll('td.password');
            passwords.forEach(function(password) {
                if (password.dataset.visible === 'true') {
                    password.textContent = password.dataset.hashedPassword;
                    password.dataset.visible = 'false';
                } else {
                    password.textContent = password.dataset.unhashedPassword;
                    password.dataset.visible = 'true';
                }
            });
        }
    </script>
</head>

<body>
    <h1>View Users</h1>
    <button onclick="togglePasswords()">Toggle Passwords</button>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Password (Hashed)</th>
                <th>Password (Unhashed)</th>
            </tr>
        </thead>
        <tbody>
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

            // SQL query to fetch all users
            $sql = "SELECT Username, Password FROM credential";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Username"] . "</td>";
                    // Display hashed password
                    echo "<td class='password' data-visible='true' data-hashed-password='" . $row["Password"] . "'>" . str_repeat("*", strlen($row["Password"])) . "</td>";
                    // Display unhashed password
                    echo "<td class='password' data-visible='false' data-unhashed-password='" . $row["Password"] . "'>" . $row["Password"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>
</body>

</html>