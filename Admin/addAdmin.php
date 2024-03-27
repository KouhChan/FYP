<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <title>Admin Page</title>

</head>

<body>

    <div class="col-md-3 form-container d-flex align-items-center">
        <form action="Admin_Register.php" method="post">
            <div class="mb-3">
                <img src="Img/Uni10.jpg" style="margin: auto">
                <h4>Admin Login</h4>
                <h5>Insert ADmin To Register</h5>
                <label for="textEmail" class="form-label" style="font-weight: bold;">Email Address</label>
                <input name="email" type="name" class="form-control" placeholder="Email Address" required> <br>
                <input name="pass" type="password" class="form-control" placeholder="Password" required><br>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
    </div>

</body>

</html>