<?php

include '../db.php';
session_start();
$e = $_SESSION['email'];

$sql = "SELECT * FROM `user` WHERE email='$e'";
$sql_run = mysqli_query($conn, $sql);
if (mysqli_num_rows($sql_run) == 1) {
    $row = mysqli_fetch_assoc($sql_run);
    $name = $row['name'];
    $email = $row['email'];
    $profile_photo = $row['image'];
} else {
    header("Location: login.php");
    exit();
}

if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $image = mysqli_real_escape_string($conn, $_FILES['image']['name']);
    $tmp_img = mysqli_real_escape_string($conn, $_FILES['image']['tmp_name']);
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if ($image == '') {
        $image = $profile_photo;
    }
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    if ($_SESSION['email'] == $email) {
        $sql = "UPDATE `tuto10`.`user` SET `name` = '$name' , `email` = '$email' , `image` = '$image' WHERE (`email` = '$email')";
        $sql_run = mysqli_query($conn, $sql);
        if ($sql_run) {
            echo "<script>alert('Successfully Changes..');</script>";
            $_SESSION['profile_photo'] = $image;
            header("Location: profile.php");
            exit();
        } else {
            echo "<script>alert('Fail Changes..');</script>";
        }
    } else {
        echo "<script>alert('Do Not Match Email');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Setting</title>
  <link rel="stylesheet" href="../libs/bootstrap.min.css">
</head>
<style>
  #pf{
    width: 60px;
    height: 58px;
  }
  #pff{
    width: 100px;
    height: 100px;
  }
</style>
<body>
  <div class="navbar navbar-light bg-light">
  <?php
?>
    <div class="container-fluid w-75">
      <h4>
        <a href="../index.php" class="text-decoration-none text-dark">Home</a>
      </h4>

    <div class="float-end">
      <?php
if ($profile_photo == '') {
    echo "<img src='../images/default.png' alt='default' class='rounded-circle' id='pf'>";
} else {
    echo "<img src='../images/" . $profile_photo . "' class='rounded-circle'  alt='user's profile' id='pf'>";
}
?>
    </div>
    </div>
    </div>
      <div class="card mt-5 w-50 d-flex align-items-center justify-content-center mx-auto">
        <div class="card-header w-100">
          <h4>My Profile Setting</h4>
        </div>
        <div class="card-body w-100">
          <form action="" method="post" class="needs-validation" enctype='multipart/form-data' novalidate >
            <div class="mb-3 row">
            <div class="col-md-3">
            <?php
if ($profile_photo == '') {
    echo "<img src='../images/default.png' alt='default' class='rounded-circle' id='pff'>";
} else {
    echo "<img src='../images/" . $profile_photo . "' class='rounded-circle'  alt='user's profile' id='pff'>";
}
?>
            </div>
            <div class="col-md-3 mt-5">
            <input style="display:none" type="file" name="image" id="my-file">
            <button type="button" class="btn btn-outline-primary rounded-pill" onclick="document.getElementById('my-file').click()">Upload</button>
            </div>
            </div>
            <div class="mb-3">
              <label for="">Name</label>
              <input type="text" name="name" placeholder="name" id="name" class="form-control" value="<?php echo $name; ?>" required>
              <div class="invalid-feedback">Name is required.</div>
            </div>
            <div class="mb-3">
              <label for="">Email</label>
              <input type="email" name="email" placeholder="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
              <div class="invalid-feedback">Email is required.</div>
            </div>
            <div class="mb-3">
              <input type="submit" name="update" value="Update" class="btn btn-info float-end">
            </div>
          </form>
<?php
?>
    </div>
  </div>
  <script src="../libs/bootstrap.bundle.min.js"></script>
  <script src="../libs/bootstrap.min.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>