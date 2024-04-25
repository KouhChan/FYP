<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c065e87b98.js" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Montserrat, sans-serif;
            background: url('Img/Admin_Login_Background.png') no-repeat;
            background-size: cover;
            height: 100vh;
            overflow-x: hidden;
            transition: all .5s ease;
        }

        nav {
            background: rgb(1, 116, 136);
            height: 80px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        nav ul {
            list-style: none;
            display: flex;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 17px;
            padding: 7px 13px;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .sidebar {
            position: fixed;
            left: -250px;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #042331;
            transition: all .5s ease;
            padding-top: 80px;
        }

        .sidebar ul {
            padding: 0;
        }

        .sidebar ul a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
            transition: .3s;
        }

        .sidebar ul a:hover {
            background-color: #063146;
        }

        .tepi {
            position: fixed;
            color: white;
            font-size: 25px;
            left: 0;
            top: 0;
            line-height: 80px;
            padding: 0 20px;
            font-weight: bold;
            z-index: 999;
            transition: all .5s ease;
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
            z-index: 999;
        }

        label #btn {
            left: 20px;
            top: 25px;
            font-size: 30px;
            color: white;
            padding: 6px 12px;
            transition: all .5s;
        }

        label #cancel {
            left: -195px;
            top: 25px;
            font-size: 30px;
            color: #0a5275;
            padding: 4px 9px;
            transition: all .5s ease;
        }

        .main--content {
            margin-left: 250px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .feedback-image img {
            width: 100%;
            max-width: 300px;
            display: block;
            margin: auto;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <nav>
        <div class="nav-new">
            <ul>
                <li><a href="#" class="active">STUDENT HUB</a></li>
                <li><a href="#">BRIGHTEN</a></li>
                <li><a href="#">INFO365</a></li>
            </ul>
        </div>

        <label for="check" class="tepi">
            <a href="Admin_Dashboard.html" style="color: white; text-decoration: none;">UNITENShuttleTrack</a>
        </label>

        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-bars" id="btn"></i>
            <i class="fas fa-times" id="cancel"></i>
        </label>
    </nav>

    <div class="sidebar">
        <header>My App</header>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="#"><i class="fas fa-user"></i>Admin</a></li>
            <li><a href="#"><i class="fas fa-qrcode"></i>Bus Interface</a></li>
        </ul>
    </div>

    <div class="main--content">
        <div class="container feedback-form">
            <div class="feedback-image">
                <img src="Img/Uni10.jpg" alt="">
            </div>
            <div class="container mt-3">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="tbody1"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
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
        const db = firebase.database();
        const dbRef = db.ref("Report");

        function populateTableWithData(data) {
            const tbody = document.getElementById("tbody1");
            tbody.innerHTML = ""; // Clear existing table content

            data.forEach(item => {
                const {
                    ID,
                    nama,
                    Date
                } = item;
                const row = `
                    <tr>
                        <td>${ID}</td>
                        <td>${nama}</td>
                        <td>${Date}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        // Fetch data once when the page loads
        window.onload = function() {
            dbRef.on("value", snapshot => {
                const data = [];
                snapshot.forEach(childSnapshot => {
                    data.push(childSnapshot.val());
                });
                populateTableWithData(data);
            });
        };
    </script>

</body>

</html>