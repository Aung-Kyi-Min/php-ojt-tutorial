 <?php
include 'db.php';
session_start();
//create
if (isset($_POST['create'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $publish = mysqli_real_escape_string($conn, $_POST['publish']);

    $checkbox = isset($_POST['publish']) ? $_POST['publish']= '1' : $_POST['publish']= '0';
    var_dump($checkbox);
    var_dump($title);
    var_dump($content);
    $query = "INSERT INTO `post` ( `title`, `content` ,`is_published`)
  VALUES ('$title', '$content','$checkbox')";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        $_SESSION['message'] = "Post Created Successfully...";
        echo "<script>window.location='create.php'</script>";
        exit(0);
    } else {
        $_SESSION['message'] = "Fail Creating ...";
        echo "<script>window.location='create.php'</script>";
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
  <title>Student CRUD!</title>
</head>
<body class="">
  <div class="container mt-5 " >
  <?php
if (isset($_SESSION['message'])):
?>
  <div class="alert alert-success alert-dismissible fade
    show d-flex align-items-center justify-content-center w-75 mx-auto" role="alert">
      <strong> Hey! </strong> <?=$_SESSION['message'];?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  <?php
unset($_SESSION['message']);
endif;
?>
    <div class="row d-flex align-items-center justify-content-center w-75 mx-auto">
      <div class="">
        <div class="card ">
          <div class="card-header">
            <h4>
              Create Post
            </h4>
          </div>
          <div class="card-body">
            <form action="create.php" method="POST" class="needs-validation" novalidate>

              <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" placeholder="Enter Title..." class="form-control" required>
                <div class="invalid-feedback">Title is required.</div>
              </div>
              <div class="mb-3">
                <label for="">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                <div class="invalid-feedback">Content is required.</div>
              </div>
              <div class="mb-3">
              <input class="form-check-input" type="checkbox"  name="publish" id="publish" >
              <label class="form-check-label" for="publish">
                Publish
              </label>
              </div>
              <div class="mb-3">
                <a href="index.php" class="btn btn-secondary">Back</a>
                <button type="submit" name="create" class="btn btn-primary float-end">Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="libs/bootstrap.min.js"></script>
<script src="libs/bootstrap.bundle.min.js"></script>
<script>
    (() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
</body>
</html>


