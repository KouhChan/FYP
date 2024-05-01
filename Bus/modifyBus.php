<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Bus Information</title>
</head>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c065e87b98.js" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <title>View Buses</title>
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

        .modify-button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .modify-button:hover {
            background-color: #0056b3;
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

        <h2 class="tepi"><a href="Admin_Dashboard.html" style="color: white;text-decoration: none;">UNITENShuttleTrack</a>
        </h2>

        <div class="sidebar">
            <header>My App</header>
            <ul>
                <li><a href="#"><i class="fas"></i>Dashboard</a></li>
                <li><a href="List_Admin_Interface.php"><i class="fas"></i>Admin</a></li>
                <li>
                    <Bus href="#"><i class="fas fa-qrcode"></i>Bus Interface</a>
                </li>
            </ul>
        </div>

    </nav>
    <div class="container">
        <h3>Update Bus Information</h3>
        <form id="modifyBus" action="modifyBusInfo.php" method="POST">
            <label for="busID">Bus ID:</label><br>
            <input type="text" class="form-control" id="BusID"><br>
            <label for="busPlat">Plat Number:</label><br>
            <input type="text" class="form-control" id="busPlat" value="<?php echo $row['Plat_No']; ?>" name="busPlat"><br>


            <label for="personIncharge">Person Incharge:</label><br>
            <input type="text" class="form-control" id="personIncharge" value="<?php echo $row['Person_Incharge']; ?>" name="personIncharge"><br>

            <label for="dateCreated">Date Created:</label><br>

            <input type="date" class="form-control" id="dateCreated" value="<?php echo $row['Date_Created']; ?> " name=" dateCreated"><br>

            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="submit">Modify</button>
                <a href="View_Bus.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>

    </div>
    </div>

    <script>
        // Initialize Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
            authDomain: "university-bus-system.firebaseapp.com",
            databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "university-bus-system",
            storageBucket: "university-bus-system.appspot.com",
            messagingSenderId: "446380655695",
            appId: "1:446380655695:web:ee019fad4684435252163a"
        };
        firebase.initializeApp(firebaseConfig);

        // Reference to your Firebase Realtime Database
        const database = firebase.database();

        // Function to fetch bus data from Firebase and populate the form fields
        function fetchBusData() {
            // Retrieve Bus ID from the URL parameter
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const busID = urlParams.get('bus_id');

            // Reference to the 'Bus' node in database
            const busRef = database.ref('Bus/' + busID);

            // Fetch bus information
            busRef.once('value', function(snapshot) {
                const busData = snapshot.val();
                if (busData) {
                    // Populate the form fields with bus information
                    document.getElementById('BusID').value = busID;
                    document.getElementById('busPlat').value = busData.PlatNo || '';
                    document.getElementById('personIncharge').value = busData.PersonIncharge || '';
                    document.getElementById('dateCreated').value = busData.Date || '';
                } else {
                    console.log("No bus found with Bus ID: " + busID);
                }
            });
        }

        // Call the function to fetch and populate bus data
        fetchBusData();

        // Function to handle form submission
        document.getElementById('modifyBus').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Retrieve form data
            const busID = document.getElementById('BusID').value;
            const busPlat = document.getElementById('busPlat').value;
            const personIncharge = document.getElementById('personIncharge').value;
            const dateCreated = document.getElementById('dateCreated').value;

            // Reference to the bus node in the database
            const busRef = database.ref('Bus/' + busID);

            // Update bus information in the database
            busRef.update({
                PlatNo: busPlat,
                PersonIncharge: personIncharge,
                Date: dateCreated
            }).then(function() {
                console.log("Bus information updated successfully.");
                // Redirect to View_Bus.php or any other page
                window.location.href = "View_Bus.php";
            }).catch(function(error) {
                console.error("Error updating bus information:", error);
            });
        });
    </script>
</body>

</html>