<?php
include '../db.php';
session_start();
if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $sql = "SELECT * FROM `tuto10`.`user` WHERE name='$name'";
    $sql_run = mysqli_query($conn, $sql);
    if ($sql_run) {
        $nums = mysqli_num_rows($sql_run);
        if ($nums > 0) {
            $_SESSION['message'] = "User Already Created...";
            echo "<script>window.location='register.php'</script>";
            exit(0);
        } else {
            $query = "INSERT INTO `tuto10`.`user` ( `name`, `email`,`phone`,`password`,`address`)
          VALUES ('$name', '$email','$phone','$password','$address')";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                echo "sdkfjs;";
                $_SESSION['message'] = "User Created Successfully...";
                echo "<script>window.location='register.php'</script>";
                exit(0);
            } else {
                $_SESSION['message'] = "Fail User Creating ...";
                echo "<script>window.location='../index.php'</script>";
                //    exit(0);
            }
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
  <?php
if (isset($_SESSION['message'])):
?>
  <div class="alert alert-success alert-dismissible fade
    show d-flex align-items-center justify-content-center w-100 mx-auto" role="alert">
      <strong> Hey! &nbsp; </strong> <?=$_SESSION['message'];?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
unset($_SESSION['message']);
endif;
?>
    <div class="card text-dark">
      <div class="card-header">
        <h1>Register</h1>
      </div>
      <div class="card-body">
        <form action="" method="post" class="needs-validation" novalidate >
        <div class="mb-3">
          <label for="">Name</label>
          <input type="text" name="name" autocomplete="off" required class="form-control" placeholder="Name" aria-label="Username" aria-describedby="basic-addon1">
          <div class="invalid-feedback">Name is required.</div>
        </div>
        <div class="mb-3">
          <label for="">Email</label>
          <input type="email" name="email" autocomplete="off" required class="form-control" placeholder="name@example.com" aria-label="Username" aria-describedby="basic-addon1">
          <div class="invalid-feedback">Email is required.</div>
        </div>
        <div class="mb-3">
          <label for="">Phone</label>
          <input type="text" name="phone" autocomplete="off" required class="form-control" placeholder="09**********" aria-label="Username" aria-describedby="basic-addon1">
          <div class="invalid-feedback">Phone is required.</div>
        </div>
        <div class="mb-3">
          <label for="">Password</label>
          <input type="password" name="password" autocomplete="off" required class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
          <div class="invalid-feedback">Password is required.</div>
        </div>
        <div class="mb-3">
          <label for="">Address</label>
          <input type="text" name="address" autocomplete="off" required class="form-control" placeholder="Address" aria-label="Username" aria-describedby="basic-addon1">
          <div class="invalid-feedback">Address is required.</div>
        </div>
        <div class="mb-3">
          <input type="submit" class="btn btn-primary w-100" value="Register" name="register">
        </div>
        </form>
      </div>
      <div class="card-footer text-center">
          <p>Already Have an account ? <a href="login.php" class="text-info">Sign_In</a></p>
      </div>
    </div>
  </div>
  <script src="../libs/bootstrap.bundle.min.js"></script>
  <script src="../libs/bootstrap.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>