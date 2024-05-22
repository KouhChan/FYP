<?php
include 'auth.php';
?>

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


    <title>Admin Dashboard</title>
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
            background: url('Img/Admin_Login_Background.png') no-repeat;
            background-size: cover;
            height: 100vh;
            background-position: center;
            overflow-x: hidden;
            transition: all .5s ease;
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



        a.active {
            background: rgb(1, 116, 136);
        }

        a:hover {
            background: rgb(1, 130, 140);
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

        .map-container {
            position: fixed;
            top: 80px;
            margin-left: 50%;
            width: calc(100% - 250px);
            height: calc(100% - 80px);
            padding: 20px;
        }

        .map {
            width: 50%;
            height: 100%;
        }

        .back {
            padding: 9px;
            text-align: center;
            background: rgb(1, 116, 136);
            border-radius: 3px;
            color: white;
        }

        .container {
            position: fixed;
            width: 40%;
            margin-top: 19%;
            margin-left: 18%;
            background: white;
            border-radius: 8px;
            padding: 25px;
        }

        .img {
            position: absolute;
            margin-top: 5%;
            margin-left: 140%;
        }

        .link {
            margin-left: 80%;
        }
    </style>
    <link rel="stylesheet" href="../CSS/mediaFile.css">
</head>

<body>

    <nav>
        <div>

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
            <header>Admin Dashboard</header>
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

            <div>
                <img src="Img/Time Schedule.png" width="430" alt="" class="img">
            </div>

            <div class="container text-center">
                <section class="table_body">
                    <h3 class="back">Student Feedback</h3>
                    <table class="table table-primary">
                        <thead>
                            <tr class="table-info">
                                <th>ID</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                </section>
                <tbody class="table-light" id="busTableBody">
                    <!-- Data will be dynamically populated here -->
                </tbody>
                </table>
                <a href="AdminReport.php" class="link">More>></a>
            </div>
        </div>

        <div class="map-container">
            <div class="map" id="map"></div>
        </div>

        <script>
            var map;
            var mark;
            var lineCoords = [];

            window.lat = 2.97690;
            window.lng = 101.72812857567598;


            const firebaseConfig = {
                apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
                authDomain: "university-bus-system.firebaseapp.com",
                databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
                projectId: "university-bus-system",
                storageBucket: "university-bus-system.appspot.com",
                messagingSenderId: "446380655695",
                appId: "1:446380655695:web:ee019fad4684435252163a"
            }

            firebase.initializeApp(firebaseConfig);

            var ref = firebase.database().ref('gps');

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 18
                });

                var busIcon = {
                    url: 'https://cdn-icons-png.flaticon.com/512/5030/5030991.png',
                    scaledSize: new google.maps.Size(50, 50),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(25, 25)
                };

                mark = new google.maps.Marker({
                    position: {
                        lat: lat,
                        lng: lng
                    },
                    map: map,
                    title: 'UNITEN',
                    icon: busIcon
                });
            }

            ref.on("value", function(snapshot) {
                var gps = snapshot.val();
                console.log(gps.latitude);
                console.log(gps.longitude);

                if (map && mark) {
                    map.setCenter({
                        lat: gps.latitude,
                        lng: gps.longitude
                    });

                    mark.setPosition({
                        lat: gps.latitude,
                        lng: gps.longitude
                    });


                    lineCoords.push(new google.maps.LatLng(gps.latitude, gps.longitude));

                    var lineCoordinatesPath = new google.maps.Polyline({
                        path: lineCoords,
                        geodesic: true,
                        strokeColor: '#2E10FF'
                    });

                    lineCoordinatesPath.setMap(map);
                }
            });
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm_aJ9lxcthdOugBg_c8q-P-vvT12ULMA&callback=initMap"></script>
        <script src="../JS/viewReportDashboard.js"></script>

    </nav>

</body>

</html>