<?php
require "db.php";
$sql = "CREATE TABLE IF NOT EXISTS `user` (
  id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(225) NOT NULL,
  email VARCHAR(225) NOT NULL UNIQUE ,
  password VARCHAR(225) NOT NULL,
  phone VARCHAR(225) NOT NULL,
  image VARCHAR(225) ,
  address text(225) NOT NULL,
  created_datetime timestamp default current_timestamp,
  updated_datetime timestamp default current_timestamp
  )";

if (mysqli_query($conn, $sql)) {
    //echo "Tutorial_08 table created successfully";
}
