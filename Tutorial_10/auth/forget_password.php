<?php
include '../db.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../libs/phpmailer/src/Exception.php';
require '../libs/phpmailer/src/PHPMailer.php';
require '../libs/phpmailer/src/SMTP.php';

if (isset($_POST["recover"])) {
    $email = $_POST["email"];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email='" . $email . "'");
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $_SESSION['email'] = $email;
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'galaxyfighter1000@gmail.com';
        $mail->Password = 'qplvuaoytreyycms';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('galaxyfighter1000@gmail.com');
        $mail->addAddress($_POST['email']);
        $mail->isHTML(true);

        $mail->Subject = "Recover your password";
        $mail->Body = "<b>Dear User</b>
        <h3>We received a request to reset your password.</h3>
        <p>Kindly click the below link to reset your password</p>
        http://localhost/php-ojt-tutorials/Tutorial_10/auth/reset_password.php?email= " . $_SESSION['email'] . "
        <br><br>
        <p>With regrads,</p>
        <b>Programming with Lam</b>";
        $mail->send();
        echo "<script>alert('Message Has Been Sent');</script>";
    } else {
        echo "Fail";
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
<main class="login-form">
    <div class="cotainer">
        <div class="row w-50 d-flex align-items-center mx-auto mt-5 justify-content-center ">
                <div class="card w-75">
                    <div class="card-header">
                      <h3>
                      Forget Password
                      </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" name="recover_psw" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="email_address" class="mb-3">E-Mail</label>
                                <input type="text" id="email_address" class="form-control" placeholder="name@example.com" name="email" required>
                                <div class="invalid-feedback">Email is required.</div>
                              </div>
                    </div>
                    <div class="card-footer">
                      <div class="mb-3">
                          <a href="login.php" class="text-decoration-none text-info">Login</a>
                          <input type="submit" value="Recover" name="recover" class="btn btn-primary float-end">
                      </div>
                    </div>
                    </form>
                </div>
        </div>
    </div>
</main>
<script src="../libs/bootstrap.bundle.min.js"></script>
<script src="../libs/bootstrap.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>
