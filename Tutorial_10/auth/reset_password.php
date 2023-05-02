<?php
include '../db.php';
session_start();
$e = $_SESSION['email'];

if (isset($_POST['confirm'])) {
    $email1 = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));
    $cpassword = md5(mysqli_real_escape_string($conn, $_POST['cpassword']));

    if (isset($_SESSION['email'])) {
        if ($password == $cpassword) {
            $sql = "UPDATE `tuto10`.`user` SET `password` = '$password' WHERE (`email` = '$e')";
            $sql_run = mysqli_query($conn, $sql);
            if ($sql_run) {
                echo "<script>alert('Successfully Changes..');</script>";
                echo "<script>window.location='login.php'</script>";
            } else {
                echo "<script>alert('Fail Changes..');</script>";
            }

        } else {
            echo "<script>alert('Unmatch Password....');</script>";
        }
    } else {
        echo "unmatch email...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forget Password</title>
  <link rel="stylesheet" href="../libs/bootstrap.min.css">
</head>
<body>

<div class="container">
  <div class="row mt-5 d-flex align-items-center justify-content-center mx-auto w-50">
    <div class="card">
      <div class="card-header">
        <h3>
          Reset Password
        </h3>
      </div>
      <div class="card-body">
        <form action="" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
          <label for="">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo $e ?>" disabled required>
          <div class="invalid-feedback">Email is required.</div>
        </div>
        <div class="mb-3">
          <label for="">New Password</label>
          <input type="password" name="password" id="password" placeholder="************" class="form-control"  required>
          <div class="invalid-feedback">Password is required.</div>
        </div>
        <div class="mb-3">
          <label for="">Confirm Password</label>
          <input type="password" name="cpassword" id="cpassword" placeholder="************" class="form-control" required>
          <div class="invalid-feedback">Confirm Password is required.</div>
        </div>
      </div>
      <div class="card-footer">
        <div class="mb-3">
          <input type="submit" name="confirm" value="Confirm" class="btn btn-primary float-end">
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
<script src="../libs/bootstrap.bundle.min.js"></script>
<script src="../libs/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
