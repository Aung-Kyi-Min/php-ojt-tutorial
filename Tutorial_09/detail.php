<?php
require 'db.php';
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $query = "SELECT * FROM tuto08.post WHERE id='$post_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $post = mysqli_fetch_array($query_run);
        $newdate = strtotime($post['created_datetime']);
        $showdate = date("M-D-Y", $newdate);
        ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="libs/bootstrap.min.css">

  <title>Tutorial_08 CRUD!</title>
</head>
<body class="">
  <div class="container mt-5 " >
    <div class="row d-flex align-items-center justify-content-center mx-auto w-75">
      <div class="">
        <div class="card ">
          <div class="card-header">
            <h4>
              Post Details
            </h4>
          </div>
          <div class="card-body">
                      <input type="hidden" name="post_id" placeholder="Enter Name..." class="form-control" value="<?=$post['id'];?>">
                        <div class="mb-3">
                            <h3><?=$post['title'];?></h3>
                            <p>
                            <?= ($post['is_published'] == '1') ? "Published" : "UnPublished" ;?> at <?=$showdate;?>
                            </p>
                            <?=$post['content'];?><br>
                            <a href="index.php" class="btn btn-secondary mt-3">Back</a>
                        </div>
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