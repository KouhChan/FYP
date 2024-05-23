<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c065e87b98.js" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-database.js"></script>

    <title>Student Dashboard</title>
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
            background-color: transparent;
            height: 100vh;
            overflow-x: hidden;
            transition: all .5s ease;
            position: relative;
            /* Ensure that the pseudo-element is positioned relative to the body */
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('../Admin/Img/Admin_Login_Background.png') no-repeat center center;
            background-size: cover;
            opacity: 0.5;
            /* Set the opacity of the background image */
            z-index: -1;
            /* Ensure the pseudo-element is behind the content */
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

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .map-container {
            position: fixed;
            top: 200px;
            margin-left: 50%;
            width: calc(100% - 250px);
            height: calc(100% - 80px);
            padding: 20px;
        }

        .map {
            width: 50%;
            height: 80%;
        }

        .img {
            position: fixed;
            margin-top: 10%;
            margin-left: 15%;
            transition: all .5s ease;
        }



        .background .container {
            max-width: 1000px;
            width: 100%;
        }

        .container .steps {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .steps .circle {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            font-weight: 500;
            height: 90px;
            width: 90px;
            background: white;
            border-radius: 50%;
            border: 4px solid #e0e0e0;
        }

        .steps .progress {
            position: absolute;
            height: 4px;
            width: 100%;
            background: #e0e0e0;
            z-index: -1;
        }

        .progress .indicator {
            position: absolute;
            height: 100%;
            width: 100%;
            background: #4070f4;
        }

        .progress .indicator2 {
            position: absolute;
            bottom: 10px;
            height: 100%;
            width: 100%;
            background: red;
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


        <h2 class="tepi"><a href="Student_Dashboard.php" style="color: white;text-decoration: none;">UNITENShuttleTrack</a></h2>

        <div class="sidebar">
            <header>Student Dashboard</header>
            <ul>
                <li><a href="Student_Dashboard.php"><i class="fas"></i>Dashboard</a></li>
                <li><a href="studentNotification.php"><i class="fas"></i>Notification</a></li>
                <li><a href="#"><i class="fas"></i>Routes</a></li>
                <li><a href="Student_Feedback.php"><i class="fas"></i>Report</a></li>
            </ul>

            <div>
                <img src="../Admin/Img/Time Schedule.png" width="600" alt="" class="img">
            </div>
        </div>
    </nav>
    <div class="background">
        <div class="container">
            <div class="steps">
                <span class="circle">LIBRARY</span>
                <span class="circle">ADMIN</span>
                <span class="circle">MURNI</span>
                <span class="circle">AMANAH</span>
                <span class="circle">DSS</span>
                <span class="circle">ILMU</span>
                <span class="circle">COE</span>
                <div class="progress">
                    <span class="indicator">
                    </span>
                    <span class="indicator2"></span>
                </div>
            </div>
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

        const firebaseConfig = {
            aapiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
            authDomain: "university-bus-system.firebaseapp.com",
            databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "university-bus-system",
            storageBucket: "university-bus-system.appspot.com",
            messagingSenderId: "446380655695",
            appId: "1:446380655695:web:ee019fad4684435252163a"
        }

        firebase.initializeApp(firebaseConfig);

        var ref = firebase.database().ref('gps');

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
</body>

</html>