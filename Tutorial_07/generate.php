<?php
require_once 'libs/phpqrcode/qrlib.php';
$path = "images/";
if (!is_dir($path)) {
    mkdir($path);
}

$text = "";
if (isset($_POST['submit'])) {
    $name = $_POST['name']; // changes
    $Qname = $name . '.png';
$file = $path . $name . '.png';
    if (isset($_POST['name'])) {
        $text = "Name: " . $_POST['name'] . "\n";
    }
    QRcode::png($text, $file, 'H', 2, 1);

    //changes
    echo '<div class="mt-4 d-flex aligns-items-center mt-5 justify-content-center mx-auto">
    <img class="img-thumbnail border-dark w-25 " src="' . $file . '" alt="">
  </div>';
}
