<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/c065e87b98.js" crossorigin="anonymous"></script>
  <title>View Users</title>
  <style>
    * {
      padding: 0;
      margin: 0;
      text-decoration: none;
      list-style: none;
      box-sizing: border-box;
    }

    body {
      font-family: montserrat;
    }

    nav {
      background: rgb(1, 116, 136);
      height: 80px;
      width: 100%;
    }


    nav ul {
      float: right;
      margin-right: 20px;
    }

    nav ul li {
      display: inline-block;
      line-height: 80px;
      margin: 0 5px;
    }

    nav ul li a {
      color: white;
      font-size: 17px;
      padding: 7px 13px;
      border-radius: 3px;
      text-transform: uppercase;
    }



    a.active,
    a:hover {
      background: #1b9bff;
      transition: .5s;
    }

    .sidebar {
      position: fixed;
      left: -250px;
      width: 250px;
      height: 100%;
      background-color: #042331;
      transition: all .5s ease;
    }

    .sidebar header {
      font-size: 22px;
      color: white;
      text-align: center;
      line-height: 70px;
      background: #063146;
      user-select: none;
    }

    .sidebar ul a {
      display: block;
      height: 100%;
      width: 100%;
      line-height: 65px;
      font-size: 20px;
      color: white;
      padding-left: 20px;
      box-sizing: border-box;
      border-bottom: 1px solid black;
      border-top: 1px solid rgba(255, 255, 255, .1);
      transition: .4s;
    }


    .sidebar ul a i {
      margin-right: 16px;
    }

    #check {
      display: none;
    }

    label #btn,
    label #cancel {
      position: absolute;
      cursor: pointer;
      background-color: #042331;
      border-radius: 3px;
    }

    label #btn {
      left: 20px;
      top: 15px;
      font-size: 35px;
      color: white;
      padding: 6px 12px;
      transition: all .5s;
    }

    label #cancel {
      z-index: 1111;
      left: -195px;
      top: 25px;
      font-size: 30px;
      color: #0a5275;
      padding: 4px 9px;
      transition: all .5s ease;
    }

    .tepi {
      position: fixed;
      color: white;
      font-size: 25px;
      left: 0px;
      line-height: 40px;
      padding: 0px 100px;
      font-weight: bold;
      transition: all .5s ease;
    }

    #check:checked~.sidebar {
      left: 0px;
    }

    #check:checked~label #btn {
      left: 250px;
      opacity: 0;
      pointer-events: none;
    }

    #check:checked~label #cancel {
      left: 195px;

    }


    #check:checked~.tepi {
      left: 160px;
    }

    body {
      background: url('Img/Admin_Login_Background.png') no-repeat;
      background-size: cover;
      height: 100vh;
      background-position: center;
      overflow-x: hidden;
      transition: all .5s ease;
    }

    .container {
      margin-top: 10px;
      background: white;
      border-radius: 8px;
      padding: 25px;
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
  <nav>
    <div class="nav-new">
      <ul>
        <li><a href="#" class="active" style="text-decoration: none;">STUDENT HUB</a></li>
        <li><a href="#" class="active" style="text-decoration: none;">BRIGHTEN</a></li>
        <li><a href="#" class="active" style="text-decoration: none;">INFO365</a></li>
      </ul>
    </div>

    <input type="checkbox" id="check">
    <label for="check">
      <i class="fas fa-bars" id="btn"></i>
      <i class="fas fa-times" id="cancel"></i>
    </label>

    <h2 class="tepi"><a href="Admin_Dashboard.html" style="color: white;text-decoration: none;">UNITENShuttleTrack</a>
    </h2>

    <div class="sidebar">
      <header>Users</header>
      <ul>
        <li><a href="Admin_Dashboard.php"><i class="fas"></i>Dashboard</a></li>
        <li><a href="../Bus/View_Bus.php">
            <i class="fas"></i>Bus</a></li>
        <li>
          <a href="List_Admin_Interface.php">
            <i class="fas"></i>User</a>
        </li>
        <li>
          <a href="AdminReport.php"><i class="fas"></i>Report</a>
      </ul>
    </div>
  </nav>

  <div class="container form-container">
    <h3>View Users</h3>
    <button onclick=" togglePasswords()">Toggle Passwords</button>
    <div class="container text-center">
      <table class="table table-bordered table-primary">
        <thead>
          <tr class="table-info">
            <th>Username</th>
            <th>Password (Hashed)</th>
            <th>Password (Unhashed)</th>
          </tr>
        </thead>
        <tbody class="table-light">
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
    </div>
  </div>
</body>

</html>