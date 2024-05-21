<?php
include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c065e87b98.js" crossorigin="anonymous"></script>
    <!-- Add Firebase SDK -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <title>View Report</title>
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
            left: 210px;
            margin-top: 15px;

        }

        #check:checked~.tepi {
            left: 160px;
        }

        body {
            background: url('../Admin/Img/Admin_Login_Background.png') no-repeat;
            background-size: cover;
            height: 100vh;
            background-position: center;
            overflow-x: hidden;
            transition: all .5s ease;
        }

        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:first-child th:first-child {
            border-top-left-radius: 10px;
        }

        tr:first-child th:last-child {
            border-top-right-radius: 10px;
        }

        tr:last-child th:first-child {
            border-top-left-radius: 10px;
        }

        tr:last-child th:last-child {
            border-top-right-radius: 10px;
        }

        .view-button {
            display: inline-block;
            background-color: green;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .view-button:hover {
            background-color: #32612D;
        }

        .remove-button {
            display: inline-block;
            background-color: #BC544B;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            justify-content: center;
        }

        .remove-button:hover {
            background-color: red;
        }

        .add-button {
            display: inline-block;
            background-color: green;
            color: white;
            padding: 1px 20px;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back {
            padding: 9px;
            text-align: center;
        }

        .container {
            margin-top: 10px;
            background: white;
            border-radius: 8px;
            padding: 25px;
        }

        .logout {
            margin-top: 300%;
            margin-left: 0%;
            /* Push the button to the bottom */
        }

        .logout a {
            display: flex;
            height: 100%;
            width: 100%;
            line-height: 65px;
            font-size: 25px;
            color: white;
            padding-left: 70px;
            box-sizing: border-box;
            border-top: 1px solid rgba(255, 255, 255, .1);
            transition: .4s;
        }

        .logout a:hover {
            background: rgba(255, 255, 255, 0.1);
            transition: .5s;
        }
    </style>
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

        <h2 class="tepi"><a href="Admin_Dashboard.php" style="color: white;text-decoration: none;">UNITENShuttleTrack</a>
        </h2>

        <div class="sidebar">
            <header>Report</header>
            <ul>
                <li><a href="Admin_Dashboard.php"><i class="fas"></i>Dashboard</a></li>
                <li><a href="../Bus/View_Bus.php">
                        <i class="fas"></i>Bus</a></li>
                <li>
                    <a href="viewAdmin.php">
                        <i class="fas"></i>User</a>
                </li>
                <li>
                    <a href="AdminReport.php"><i class="fas"></i>Report</a>
                </li>
            </ul>
            <div class="logout">
                <a href="../Admin/logout.php"><i class="fas"></i>LOGOUT</a>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <section class="table_body">
            <h3 class="back">Report</h3>
            <table class="table table-primary">
                <thead>
                    <tr class="table-info">
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Report</th>
                        <th>Action</th>
                    </tr>
                </thead>
        </section>
        <tbody class="table-light" id="busTableBody">
            <!-- Data will be dynamically populated here -->
        </tbody>
        </table>
    </div>


    <script src="../JS/view&delReport.js"></script>
    <script src="../JS/deleteBus.js"></script>

</body>

</html>