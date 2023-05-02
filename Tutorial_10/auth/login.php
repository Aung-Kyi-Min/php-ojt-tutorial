<?php
include '../db.php';
session_start();

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $query = "SELECT * FROM `tuto10`.`user` WHERE email='$email' and password='$password'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $num = mysqli_num_rows($query_run);
        if ($num > 0) {
            $_SESSION['email'] = $email;
            echo "<script>alert('Login Successfully...');</script>";
            echo "<script>window.location='../index.php'</script>";
            exit(0);
        } else {
            echo "<script>window.location='login.php'</script>";
            exit(0);
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../libs/bootstrap.min.css">
  <title>Register</title>

  <style>
    input:focus{
      outline: 0 0 0 0 !important;
      box-shadow: 0 0 0 0 !important;
    }
  </style>
</head>
<body class="">
  <div class="container w-50 mt-5 ">
    <div class="card text-dark">
      <div class="card-header">
        <h1>Login</h1>
      </div>
      <div class="card-body">
        <form action="login.php" method="post" class="needs-validation" novalidate >
        <div class="mb-3">
          <label for="">Email</label>
          <input type="email" name="email" autocomplete="off" required class="form-control" placeholder="example@gmail.com" aria-label="email" aria-describedby="basic-addon1">
          <div class="invalid-feedback">Email is required.</div>
        </div>
        <div class="mb-3">
          <label for="">Password</label>
          <input type="text" name="password" autocomplete="off" required class="form-control" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
          <a href="forget_password.php" class="text-decoration-none mt-3">forget_password?</a>
          <div class="invalid-feedback">Password is required.</div>
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-primary w-100" value="Login" name="login">
        </div>
        </form>
      </div>
      <div class="card-footer text-center">
          <p>Not a member ? <a href="register.php" class="text-info">Sign_Up</a></p>
      </div>
    </div>
  </div>
  <script src="../libs/bootstrap.min.js"></script>
  <script src="../libs/bootstrap.bundle.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>
