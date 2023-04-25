<?php

session_start();

if (isset($_POST['submit'])) {
    $new_date = date('y-m-d', strtotime($_POST['dob']));
    $bday = new DateTime($new_date);
    $today = new DateTime(date('y-m-d'));
    $input = new DateTime($new_date);
    $diff = $today->diff($bday);

    if ($bday > $today || $input == $today) {
        $_SESSION['message'] = 'Date must not greater than or equal tomorrow';
    } else
    if (isset($_POST['dob']) && $_POST['dob'] != '') {
        $_SESSION['message'] = 'Your Age is: ' . $diff->y . ' Years ' . ' , ' . $diff->m . ' months and ' . $diff->d . ' days .';
    } else {
        $_SESSION['message'] = "U need to input ur DOB";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Compute Age in PHP</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="libs/bootstrap.min.css">
</head>

<body>
<div class="age d-flex w-50 align-items-center justify-content-center mx-auto text-center" >
<?php
if (isset($_SESSION['message'])):
?>
<div class="alert w-75 alert-success alert-dismissible fade show" role="alert">
    <h3> <?php echo $_SESSION['message']; ?>  </h3>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php
unset($_SESSION['message']);
endif;
?>
<div class="card w-75 ">
<div class="card-header bg">
<h1 class="center">Age Calculator</h1>
</div>
<div class="card-body">
<form class="text-center" method="post">
<div class="input-wrapper">
<label>Date of Birth</label>
<input type="date" class="mt-1" name="dob" value="<?php ?>"><br>
<input type="submit" name="submit" class="btn btn-info mt-3 w-100" value="Calculate">
</div>
</form>
</div>
</div>
</div>
<script src="libs/bootstrap.bundle.min.js"></script>
<script src="libs/bootstrap.min.js"></script>
</body>
</html>
