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
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require 'partials/_dbconnect.php';
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        //Check whether the user exists or not!!!
    
        $existSql = "select * from users where email = '$email'";
        $result = mysqli_query($conn, $existSql);
        $numRows = mysqli_num_rows($result);
        if ($numRows > 0) {
            echo '  <div class="alert alert-danger" role="alert">
             user with ' . $email . ' already exists!!
        </div>';
        } else {
            if ($password == $cpassword) {
                $hash = password_hash($cpassword, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` ( `username`, `email`, `password`, `tstamp`) VALUES ( '$username', '$email', '$hash', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo ' <div class="alert alert-success" role="alert">
                                You are succesfully registered with '.$username.' now <a href="login.php">Log In to continue</a>
                            </div>';
                }else{
                    echo '  <div class="alert alert-danger" role="alert">
                                 Some problem from our end has occured , please try again later!!
                            </div>';
                }
            }
        }



    }



    ?>
    <br>
    <br>
    <br>
    <br>
    <center>
        <h1>Register as a new User</h1>
    </center>
    <br>
    <br>
    <div class="forms">
        <form action="register.php" method="post" style="
    position: absolute;
    max-width: 500px;
    left: 600px;
">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>