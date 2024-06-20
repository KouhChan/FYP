<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>Login</title>
  <style>
    body {
      background-image: url('Img/Admin_Login_Background.png');
      background-size: cover;
      background-repeat: no-repeat;
      display: block;
      overflow-x: hidden;
    }

    .custom-container {
      background-color: white;
      padding: 100px;
      border-radius: 10px;
    }

    .title-container {
      background-color: rgb(1, 116, 136);
      padding: 0px;
      border-radius: 10px;
      color: white;
      display: flex;
      text-align: left;
      justify-content: center;
      align-items: center;
      height: 50vh;
      margin-left: 480px;
      margin-top: 250px
    }

    .form-container {
      background-color: white;
      padding: 100px;
      border-radius: 10px;
      justify-content: center;
      align-items: center;
      height: 50vh;
      margin-left: 300px;
      margin-top: 250px
    }
  </style>
</head>

<body>
  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(1, 116, 136);">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-right: 40%;">UNITENShuttleTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="https://www.uniten.edu.my/student-hub/" style="margin-left: 200px;">STUDENT HUB</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="https://brighten.uniten.edu.my/login/index.php" style="margin-left: 200px;">BRIGHTEN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="https://info365.uniten.edu.my/info365/" style="margin-left: 200px;">INFO365</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="col-md-4 d-flex align-items-center">
      <h1 class="p-5 border  title-container" style="font-size: 50px;">UNITEN BUS TRACKING SYSTEM(ADMIN)</h1>
    </div>


    <div class="col-md-3 form-container d-flex align-items-center">
      <form id="loginform">
        <div class="mb-3">
          <img src="Img\Uni10.jpg" style="margin: auto">
          <h4>Admin Login</h4>
          <h5>Please Login To Continue</h5>
          <label for="textEmail" class="form-label" style="font-weight: bold;">Email Address</label>
          <input name="email" type="name" class="form-control" placeholder="Email Address" id="email" required> <br>
          <input name="pass" type="password" class="form-control" placeholder="Password" id="password" required><br>
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore-compat.js"></script>

  <script>
    // Firebase configuration
    const firebaseConfig = {
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

    // Get form elements
    const loginForm = document.getElementById('loginform');

    // Listen for form submission
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      // Firebase sign in
      firebase.auth().signInWithEmailAndPassword(email, password)
        .then((userCredential) => {
          // Signed in
          const user = userCredential.user;
          alert('Login successful');
          window.location.href = "../Admin/Admin_Dashboard.php";
        })
        .catch((error) => {
          const errorCode = error.code;
          const errorMessage = error.message;
          alert(`Error: ${errorMessage}`);
        });
    });

    // Check auth state
    firebase.auth().onAuthStateChanged((user) => {
      if (user) {
        // User is signed in
        console.log('User is signed in:', user);
        window.location.href = "../Admin/Admin_Dashboard.php";
      } else {
        // User is signed out
        console.log('User is signed out');
      }
    });

    // Sign out
    const signOutBtn = document.getElementById('signOutBtn');

    if (signOutBtn) {
      signOutBtn.addEventListener('click', () => {
        firebase.auth().signOut().then(() => {
          // Sign-out successful
          alert('Sign out successful');
        }).catch((error) => {
          // An error happened
          alert(`Error: ${error.message}`);
        });
      });
    }
  </script>
</body>



</html>