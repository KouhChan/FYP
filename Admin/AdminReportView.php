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
    <title>Admin Page</title>
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
            background: rgb(1, 116, 136);
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

        .feedback-form {
            background: #fff;
        }

        .feedback-form,
        .form-control {
            border-radius: 1rem;
        }

        .feedback-image {
            text-align: center;
        }

        .feedback-image img {
            width: 30%;
            margin-bottom: -15%;
            margin-top: 1%;
            transform: rotate(0deg);
            margin-left: 150px;
        }

        .feedback-form form {
            padding: 15%;
        }

        .feedback-form form .row {
            margin-bottom: -20%;
        }

        .feedback-form p {
            margin-top: 15px;
            margin-bottom: 3px;
            color: gray;
        }

        .main--content {
            position: relative;
            margin-top: 55px;
            width: 100%;
            padding: 1rem;
        }

        .background--content {
            background-color: #499af1;
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

        <h2 class="tepi"><a href="Admin_Dashboard.php" style="color: white; text-decoration: none;">UNITENShuttleTrack</a>
        </h2>

        <div class="sidebar">
            <header>My App</header>
            <ul>
                <li><a href="Student_Dashboard.php"><i class="fas"></i>Dashboard</a></li>
                <li><a href="#">
                        <i class="fas"></i>Notification</a></li>
                <li>
                    <a href="#">
                        <i class="fas"></i>Routes</a>
                </li>
                <li>
                    <a href="Student_Feedback.php"><i class="fas"></i>Report</a>
                </li>
            </ul>
        </div>
        <div class="background--content">
        </div>
        <div class="background--main"></div>
        </div>
        <div class="main--content container feedback-form">
            <div class="feedback-image">
                <img src="../Admin/Img/Uni10.jpg" alt="">
            </div>
            <form action="#" method="POST" id="report">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>Name</p>
                            <input type="text" class="form-control" placeholder="Name" id="name"><br>
                        </div>
                        <div class="form-group">
                            <p>Student ID / Staff ID</p>
                            <input type="text" class="form-control" placeholder="Student ID/Staff ID" id="SId"><br>
                        </div>
                        <div class="form-group">
                            <p>Location</p>
                            <select name="Location" class="form-select form-select-sm" id="location">
                                <option value="LIBRARY">LIBRARY</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="MURNI">MURNI</option>
                                <option value="AMANAH">AMANAH</option>
                                <option value="DSS">DSS</option>
                                <option value="ILMU">ILMU</option>
                                <option value="COE">COE</option>
                            </select><br>
                        </div>
                        <p>Description</p>
                        <textarea name="description" class="form-control" cols="30" rows="10" style="width: 600px; height: 150px; margin-bottom: 8px;" placeholder="Description" id="desc"></textarea>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <p>Date</p>
                            <input type="date" name="date" class="form-control" id="Date">
                        </div>
                    </div>
                    <div style="margin-left: 1000px;">
                        <!-- Cancel button -->
                        <a href="AdminReport.php" class="btn btn-danger">Back</a>
                    </div>
                </div>
                <script>
                    // Auto-detect current date and set it as the value for the input field
                    document.getElementById("Date").valueAsDate = new Date();
                </script>
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
                const ReportID = urlParams.get('report_id');

                // Reference to the 'Report' node in database
                const reportRef = database.ref('Report/' + ReportID);

                // Fetch bus information
                reportRef.once('value', function(snapshot) {
                    const reportData = snapshot.val();
                    if (reportData) {
                        // Populate the form fields with bus information
                        document.getElementById('SId').value = ReportID;
                        document.getElementById('name').value = reportData.nama || '';
                        document.getElementById('location').value = reportData.Location || '';
                        document.getElementById('desc').value = reportData.Report || '';
                        document.getElementById('Date').value = reportData.Date || '';
                    } else {
                        console.log("No report found with Student ID: " + SId);
                    }
                });
            }

            // Call the function to fetch and populate bus data
            fetchBusData();
        </script>

    </nav>
</body>

</html>