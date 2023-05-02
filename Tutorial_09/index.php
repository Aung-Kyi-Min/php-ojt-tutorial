<?php
include 'db.php';
//include 'dummy.php';
session_start();
//select
$query = "SELECT * FROM tuto08.post";
$query_run = mysqli_query($conn, $query);
//Delete
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $query = "DELETE FROM tuto08.post WHERE id='$post_id'";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Posts Deleted Successfully...";
        echo "<script>window.location='index.php'</script>";
        exit(0);
    } else {
        $_SESSION['message'] = "Posts Not Deleted...";
        echo "<script>window.location='index.php'</script>";
        exit(0);
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
  <link rel="stylesheet" href="libs/bootstrap.min.css">

  <title>Tutorial_09 CRUD!</title>
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
    <div class="row position-relative">
      <div class="col-md-12">
      <a href="create.php" class="btn btn-primary position-absolute top-20 start-2">Create</a>
      <a href="graph/_yearly.php" class="btn btn-dark float-end">Graph</a>
        <div class="card mt-5">
          <div class="card-header">
            <h4>
               Post List
            </h4>
          </div>
          <div class="card-body">
            <table class="table table-striped text-center text-dark">
              <thead>
                <th>id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Is_Published</th>
                <th>Created_datetime</th>
                <th>Action</th>
              </thead>
              <tbody>
              <?php
if (mysqli_num_rows($query_run) > 0) {

    foreach ($query_run as $post) {
      $newdate = strtotime($post['created_datetime']);
      $showdate = date("M-D-Y", $newdate);
        ?>
                  <tr>
                    <td><?=$post['id'];?></td>
                    <td><?=$post['title'];?></td>
                    <td><?=mb_strimwidth($post['content'], 0, 20, "...")?></td>
                    <td><?=($post['is_published'] == '1') ? "Published" : "UnPublished"?></td>
                    <td><?=$showdate;?></td>
                    <td>
                      <a href="detail.php?id=<?=$post['id'];?>" class="btn btn-info btn-sm">View</a>
                      <a href="edit.php?id=<?=$post['id'];?> " class="btn btn-success btn-sm">Edit</a>
                      <form action="index.php" method="get" class="d-inline">
                        <a href="index.php?id=<?=$post['id'];?>" name="delete" onclick="return confirm('Are you sure u want to delete?')"
                         class="btn btn-danger btn-sm">Delete</a>
                      </form>
                    </td>
                  </tr>
              <?php
}
} else {
    echo "No Datat Here...";
}
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="libs/bootstrap.min.js"></script>
<script src="libs/bootstrap.bundle.min.js"></script>
</body>

</html>







