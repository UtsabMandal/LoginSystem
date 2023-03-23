<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <?php include 'partials/_navbar.php'; ?>

    <br>
    <br>
    <br>
    <br>
    <center>
        <h1>Log In as an existing user</h1>
    </center>
    <br>
    <br>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'partials/_dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $Sql = "select * from users where email = '$email' and username = username ";
    $result = mysqli_query($conn, $Sql);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['username'] = $row['username'];
            header("location: home.php");
        }else{
            echo '  <div class="alert alert-danger" role="alert">
             Password is wrong , please try again..
        </div>';
        }
    }else{
        echo '  <div class="alert alert-danger" role="alert">
             User Does not exists!!
        </div>';
    }
}



?>



    <div class="forms">
        <form action="login.php" method="post" style="
    position: absolute;
    max-width: 500px;
    left: 600px;
">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>