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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <title>Notification</title>
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
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            min-height: 100%;
            height: auto;
            background: url('../Img/bus.jpg') no-repeat center center;
            background-size: cover;
            opacity: 0.5;
            z-index: -1;
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
            top: 15px;
            font-size: 35px;
            color: white;
            padding: 6px 12px;
            transition: all .5s ease;
        }

        .tepi {
            position: static;
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


        #check:checked~.tepi {
            left: 160px;
        }

        .container {
            margin-top: 0.4%;
            margin-left: 0%;
            display: inline-flex;
            background: antiquewhite;
            width: 100vw;
            height: auto;

        }

        .notificationContainer {
            display: flex;
            align-items: stretch;
            flex-direction: column;
            background-color: white;
            width: 100%;
            margin: 2rem;
            padding: 1rem 1rem;
            border-radius: 1rem;
        }



        #num-of-notif {
            background-color: blue;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            width: 30px;
            height: 30px;
            border-radius: 0.3rem;
            margin-left: 10px;
        }


        main {
            display: contents;
            flex-direction: column;
            gap: 1rem;
        }

        .notificationCard {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 1rem;
            opacity: 0;
            transition: opacity 0.5s ease;
            margin-bottom: 1rem;
        }

        .notificationCard .description {
            margin-left: 10px;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .unread {
            background-color: pink;
        }

        .filter {
            margin-left: 82%;
            padding: 10px;
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-new">
            <ul>
                <li><a href="https://www.uniten.edu.my/student-hub/" class="active" style="text-decoration: none;">STUDENT HUB</a></li>
                <li><a href="https://brighten.uniten.edu.my/login/index.php" class="active" style="text-decoration: none;">BRIGHTEN</a></li>
                <li><a href="https://info365.uniten.edu.my/info365/" class="active" style="text-decoration: none;">INFO365</a></li>
            </ul>
        </div>

        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-bars" id="cancel"></i>
        </label>

        <h2 class="tepi"><a href="index.php" style="color: white;text-decoration: none;">UNITENShuttleTrack</a></h2>

        <div class="sidebar">
            <header> Notification</header>
            <ul>
                <li><a href="index.php"><i class="fas"></i>Dashboard</a></li>
                <li><a href="studentNotification.php"><i class="fas"></i>Notification</a></li>
                <li><a href="studentRoutes.php"><i class="fas"></i>Routes</a></li>
                <li><a href="Student_Feedback.php"><i class="fas"></i>Report</a></li>
            </ul>
        </div>

        <div class="container">
            <div class="notificationContainer">
                <h1> Notification</h1>
                <div class="filter">
                    <input type="date" id="selectedDate">
                    <button class="btn btn-success" onclick="fetchNotifications()">Filter </button>
                </div>
                <main id="notifications"></main>
            </div>

        </div>

        <script>
            // Your web app's Firebase configuration
            var firebaseConfig = {
                apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
                authDomain: "university-bus-system.firebaseapp.com",
                databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
                projectId: "university-bus-system",
                storageBucket: "university-bus-system.appspot.com",
                messagingSenderId: "446380655695",
                appId: "1:446380655695:web:ee019fad4684435252163a"
            };

            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

            // Reference to the Firebase Database
            var database = firebase.database();

            // Function to fetch and display notifications
            function fetchNotifications() {
                var selectedDate = document.getElementById('selectedDate').value;
                var selectedDateObj = new Date(selectedDate);
                var notificationsContainer = document.getElementById('notifications');
                notificationsContainer.innerHTML = ''; // Clear the container

                database.ref('Notification').orderByChild('Time').once('value', function(snapshot) {
                    snapshot.forEach(function(childSnapshot) {
                        var notification = childSnapshot.val();
                        var notificationDate = new Date(notification.Time);
                        if (notificationDate.toDateString() === selectedDateObj.toDateString()) {
                            var user = notification.User;
                            var description = notification.Description;
                            var now = moment();// Calculate time ago
                            var notificationTime = moment(notification.Time);
                            var timeDiff = now.diff(notificationTime, 'days');

                            var createdTime;
                            if(timeDiff === 0){
                                createdTime = "today";
                            }else{
                                createdTime = moment(notification.Time).fromNow();
                            }
                            var notificationCard = document.createElement('div');
                            notificationCard.className = 'notificationCard unread';

                            var descriptionDiv = document.createElement('div');
                            descriptionDiv.className = 'description';

                            var userP = document.createElement('p');
                            userP.textContent = user;

                            var descriptionP = document.createElement('p');
                            descriptionP.textContent = description;

                            var timeP = document.createElement('p');
                            timeP.textContent = createdTime; // Display time ago

                            descriptionDiv.appendChild(userP);
                            descriptionDiv.appendChild(descriptionP);
                            descriptionDiv.appendChild(timeP);

                            notificationCard.appendChild(descriptionDiv);

                            // Insert the new notification at the beginning of the container
                            notificationsContainer.insertBefore(notificationCard, notificationsContainer.firstChild);

                            void notificationCard.offsetWidth;
                            notificationCard.style.opacity = '1';
                        }
                    });
                });
            }
            document.getElementById("selectedDate").valueAsDate = new Date();
            // Fetch notifications on page load
            window.onload = fetchNotifications;
        </script>
    </nav>
</body>

</html>