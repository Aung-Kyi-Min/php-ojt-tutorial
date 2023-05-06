<?php
require 'db.php';
session_start();
//update
if (isset($_POST['update'])) {
    $post_id = mysqli_real_escape_string($conn,$_POST['pt_id']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $content = mysqli_real_escape_string($conn,$_POST['content']);
    //$publish = mysqli_real_escape_string($conn,$_POST['publish']);
    $publish = $_POST['publish'];
    if (isset($publish)) {
        $publish = '1';
    } else {
        $publish = '0';
    }
    $query = "UPDATE `tuto08`.`post` SET  title='$title' , content='$content', is_published='$publish'
             where id='$post_id' ";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Post Updated Successfully...";
        echo "<script>window.location='index.php';</script>";
        exit(0);
    } else {
        $_SESSION['message'] = "Post Not Updated...";
        echo "<script>window.location='index.php';</script>";
        exit(0);
    }
}

//var_dump($_GET['id']);
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $query = "SELECT * FROM tuto08.post WHERE id='$post_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $post = mysqli_fetch_array($query_run);
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="libs/bootstrap.min.css">

  <title>Tutorial_08 CRUD!</title>
</head>
<body class="">
  <div class="container mt-5">
  <?php
if (isset($_SESSION['message'])):
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong> Hey! </strong> <?=$_SESSION['message'];?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
unset($_SESSION['message']);
endif;
?>
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4>
              Post Edit
            </h4>
          </div>
          <div class="card-body">
                      <form action="" method="POST">
                      <input type="hidden" name="pt_id" class="form-control" value="<?=$post['id'];?>">
                        <div class="mb-3">
                          <label for="">Title</label>
                          <input type="text" name="title" placeholder="Enter Title..." class="form-control" value="<?=$post['title'];?>">
                        </div>
                        <div class="mb-3">
                          <label for="">Content</label>
                          <textarea class="form-control" id="content" name="content" rows="4"><?=$post['content'];?></textarea>
                        </div>
                        <div class="mb-3">
                          <input class="form-check-input" type="checkbox" value='' name="publish" id="publish" <?php if($post['is_published']=='1') echo 'checked="checked"'; ?>>
                          <label class="form-check-label" for="publish">
                            Publish
                          </label>
                        </div>
                        <div class="mb-3">
                        <a href="index.php" class="btn btn-secondary">Back</a>
                            <button type="submit" name="update" class="btn btn-primary float-end">Update </button>
                        </div>
                      </form>
                  <?php
} else {
        echo "NO Such Data found...";
    }
}
?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="libs/bootstrap.min.js"></script>
  <script src="libs/bootstrap.bundle.min.js"></script>
</body>
</html>