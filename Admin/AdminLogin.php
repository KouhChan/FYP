<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>Admin Page</title>
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
      margin-left: 470px;
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
        <a class="navbar-brand" href="#" style="margin-right: 100px;">UNITENShuttleTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="#" style="margin-left: 200px;">STUDENT HUB</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#" style="margin-left: 200px;">BRIGHTEN</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#" style="margin-left: 200px;">INFO365</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="col-md-4 d-flex align-items-center">
      <h1 class="p-5 border  title-container" style="font-size: 50px;">UNITEN BUS TRACKING SYSTEM(ADMIN)</h1>
    </div>


    <div class="col-md-3 form-container d-flex align-items-center">
      <form action="login_success.php" method="post">
        <div class="mb-3">
          <img src="Img\Uni10.jpg" style="margin: auto">
          <h4>Admin Login</h4>
          <h5>Please Login To Continue</h5>
          <label for="textEmail" class="form-label" style="font-weight: bold;">Email Address</label>
          <input name="email" type="name" class="form-control" placeholder="Email Address" required> <br>
          <input name="pass" type="password" class="form-control" placeholder="Password" required><br>
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
  </div>

</body>

</html>