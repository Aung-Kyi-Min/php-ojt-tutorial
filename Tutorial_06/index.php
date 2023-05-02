<?php

//session_start();
include 'upload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutoria 06</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="libs/bootstrap.min.css">
</head>
<body>
  <div class="row d-flex aligns-items-center mt-5 justify-content-center  w-50 mx-auto">

  <?php
if (isset($_SESSION['message'])):
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <h3> <?=$_SESSION['message'];?>  </h3>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
unset($_SESSION['message']);
endif;
?>
    <div class="card">
      <div class="card-header">
        <h2 class="text-center">Upload Image</h2>
        <div class="card-body">
          <form action="upload.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate >
            <div class="mb-3">
              <label for="">Folder Name</label>
              <input type="text" name="folder" class="form-control" placeholder="Enter Folder Name" required>
              <div class="invalid-feedback">
                Folder Name is required...
              </div>
            </div>
            <div class="mb-3">
              <label for="">Image</label>
              <input type="file" name="image" class="form-control" required>
              <div class="invalid-feedback">
                Image is required...
              </div>
            </div>
            <div class="mb-3">
                <input type="submit" value="Upload" class="btn btn-info btn-md w-100" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    <div class="card d-flex align-items-center justify-content-center mx-auto w-75  mt-5">
      <div class="card-body w-75">
      <div class="row  mt-5">

<?php  show();  ?>
      </div>
      </div>
    </div>
  <script src="libs/bootstrap.bundle.min.js"></script>
  <script src="libs/bootstrap.min.js"></script>
  <script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
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