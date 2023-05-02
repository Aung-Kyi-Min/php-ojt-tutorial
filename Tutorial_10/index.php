<?php
include "db.php";
include "create_table.php";
session_start();
$e = '';
if(isset($_SESSION['email'])){
  $e = $_SESSION['email'];
}
if (isset($_GET['email'])) {
    session_start();
    session_destroy();
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
$sql = "SELECT * FROM `user` WHERE email='$e'";
$sql_run = mysqli_query($conn, $sql);
$row = mysqli_num_rows($sql_run);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutorial_10</title>
  <link rel="stylesheet" href="libs/bootstrap.min.css">
</head>
<style>
  #pff{
    width: 80px;
    height: auto;
  }
</style>
<body>

  <?php
if (isset($_SESSION['email'])) {
    ?>
<div class="navbar navbar-light bg-light">
  <?php
if ($row > 0) {
        $user = mysqli_fetch_assoc($sql_run);
        ?>
    <div class="container-fluid w-75">
      <h4>
        <a href="index.php" class="text-decoration-none text-dark">Home</a>
      </h4>
    <div class="float-end">
      <?php
if ($user['image'] == '') {
            echo "<img src='images/default.png' alt='default' class='rounded-circle' id='pff'>";
        } else {
            echo "<img src='images/" . $user['image'] . "' class='rounded-circle'  alt='user's profile' id='pff'>";
        }
        ?>
    </div>
    </div>
    </div>
    <div class="profile float-end w-25">
        <form action="" method="post" class="border border-secondary rounded p-2 w-50">
        <a href="auth/profile.php" class="text-decoration-none text-dark">Profile</a><br>
        <a href="index.php?email=<?php echo $e; ?>"  class="text-decoration-none text-dark" name="logout">Logout</a>
        </form>
      </div>
    <div class="d-flex align-items-center justify-content-center w-100" style="height: 350px;">
      <h2 class="">
        Welcome From My Website
      </h2>
    </div>

    <?php
}
} else {
    ?>
  <div class="navbar w-100 navbar-light bg-light">
    <div class="container-fluid w-75">
    <h4>
      <a href="index.php" class="text-decoration-none text-dark">Home</a>
    </h4>

      <div class="float-end">
      <a href="auth/register.php" class="btn btn-primary">Register</a>
      <a href="auth/login.php" class="btn btn-primary">Login</a>
      </div>
    </div>
<div class="d-flex align-items-center justify-content-center w-100" style="height: 500px;">
<h2 class="">
  Welcome From My Website
</h2>
</div>
</div>
<?php
}
?>
</div>
<script src="libs/bootstrap.bundle.min.js"></script>
<script src="libs/bootstrap.min.js"></script>
</body>
</html>