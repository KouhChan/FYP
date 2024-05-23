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

        .container {
            margin-top: 0;
            margin-left: 0;
            display: inline-flex;
            background: antiquewhite;
            width: 100vw;
            height: 100vh;
        }

        .notificationContainer {
            background-color: white;
            width: 100%;
            margin: 2rem;
            padding: 1rem 1rem;
            border-radius: 1rem;
        }

        .notificationHeader {
            display: flex;
            align-items: center;
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

        #mark-as-read {
            color: gray;
            cursor: pointer;
            transition: 0.6s ease;
        }

        #mark-as-read:hover {
            color: black;
        }

        main {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .notificationCard {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-radius: 1rem;
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
            <header> Notification</header>
            <ul>
                <li><a href="Student_Dashboard.php"><i class="fas"></i>Dashboard</a></li>
                <li><a href="studentNotification.php"><i class="fas"></i>Notification</a></li>
                <li><a href="studentRoutes.php"><i class="fas"></i>Routes</a></li>
                <li><a href="Student_Feedback.php"><i class="fas"></i>Report</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="notificationContainer">

            <div class="notificationHeader">
                <h1> Notification</h1>
                <span id="num-of-notif"></span>
            </div>

            <main>
                <div class="notificationCard unread">
                    <img src="" alt="">
                    <div class="description">
                        <p>Hello Guys its me alip</p>
                        <p id="notif-time">1m ago</p>
                    </div>
                </div>

                <div class="notificationCard unread">
                    <img src="" alt="">
                    <div class="description">
                        <p>Hello Guys its me alip</p>
                        <p id="notif-time">1m ago</p>
                    </div>
                </div>

                <div class="notificationCard unread">
                    <img src="" alt="">
                    <div class="description">
                        <p>Hello Guys its me alip</p>
                        <p id="notif-time">1m ago</p>
                    </div>
                </div>

                <div class="notificationCard unread">
                    <img src="" alt="">
                    <div class="description">
                        <p>Hello Guys its me alip</p>
                        <p id="notif-time">1m ago</p>
                    </div>
                </div>
            </main>
        </div>

    </div>



</body>

</html>