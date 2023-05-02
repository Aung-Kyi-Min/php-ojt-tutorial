<?php
$servername = "localhost";
$username = "root";
$password = "aungkyi1000";
$dbname = "tuto08";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    //echo "Connection Successfull";
}

$sql = "CREATE TABLE IF NOT EXISTS `Post` (
  id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(225) NOT NULL,
  content VARCHAR(225) NOT NULL,
  is_published VARCHAR(10),
  created_datetime timestamp default current_timestamp,
  updated_datetime timestamp default current_timestamp
  )";

if (mysqli_query($conn, $sql)) {
//echo "Tutorial_08 table created successfully";
}

