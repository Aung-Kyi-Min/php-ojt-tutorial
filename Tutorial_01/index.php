<?php

function drawChessBorad($rows, $cols)
{
    if ($rows == 0 && is_string($cols)) {
        $err = "<p>Output : rows parameter must be greater than 0 and cols parameter must be number.</p>";
        echo $err;
        exit();
    } else if ($cols == 0 && is_string($rows)) {
        $err = "<p>Output : cols parameter must be greater than 0 and rows parameter must be number.</p>";
        echo $err;
        exit();
    }
    if (is_numeric($rows) && is_numeric($cols)) {
        $err = "<p>Output : $rows rows and $cols columns chess board.</p>";
        echo $err;
        for ($r = 1; $r <= $rows; $r++) {
            echo "<tr>";
            for ($c = 1; $c <= $cols; $c++) {
                $total = $r + $c;
                if ($total % 2 == 0) {
                    echo "<td class='white'></td>";
                } else {
                    echo "<td class='black'> </td>";
                }
            }
            echo "</tr>";
        }
    exit();
    }
    if (is_string($rows) && is_string($cols)) {
        $err = "<p>Output : rows and cols parameters must be number.</p>";
        echo $err;
        exit();
    } else
    if (is_string($rows)) {
        $err = "<p>Output : rows parameter must be number.</p>";
        echo $err;
        exit();
    } else if (is_string($cols)) {
        $err = "<p>Output : cols parameter must be number.</p>";
        echo $err;
        exit();
    }

    if ($rows == 0 && $cols == 0) {
        $err = "<p>Output : rows and cols must be greater than 0.</p>";
        echo $err;
        exit();
    } else if ($rows == 0) {
        $err = "<p>Output : rows must be greater than 0.</p>";
        echo $err;
        exit();
    } else if ($cols == 0) {
        $err = "<p>Output : cols must be greater than 0.</p>";
        echo $err;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 1</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="chess">
    <h3>ChessBorad</h3>
    <table class="item">
<?php
drawChessBorad(5,5);
?>
    </table>
    </div>
</body>
</html>