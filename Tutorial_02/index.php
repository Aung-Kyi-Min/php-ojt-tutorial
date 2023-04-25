<?php
function makeDiamondShape($rows)
{
    if (is_string($rows)) { /* fix */
        echo "<script>alert('row parameter must be number.');</script>";
        //exit(0);
    }
    function isEven($n)
    {
        return ($n % 2 == 0);
    }
    if ($rows == 0) {
        echo "<script>alert('rows must be greater than 0');</script>";
        exit(0);
    }
    if (isEven($rows) == true) {
        echo "<script>alert('rows must be Odd number..');</script>";
        exit(0);
    }
    $n = ($rows + 1) / 2;
    $m = 0;
    for ($i = 1; $i <= $rows; $i++) {
        $i <= $n ? $m++ : $m--;
        for ($j = 1; $j <= $rows; $j++) {
            if (($j >= $n + 1 - $m) && ($j <= $n - 1 + $m)) {
                echo "*";
            } else {
                echo "&nbsp;&nbsp;";
            }
        }
        echo "<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 2</title>
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="pattern">
    <h2>Diamond Pattern</h2>
	<div class="diamond">
<?php
makeDiamondShape(5);
?>
	</div>
    </div>
</body>
</html>
