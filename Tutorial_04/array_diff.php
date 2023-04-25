<?php
function arrayDiff($arr1, $arr2)
{
    if (count($arr1) == 0) {
        echo "Output : First Parameter Array should not empty...";
        exit();
    } else {
        $arrDif = array();
        $i = 0;
        $j = 0;
        foreach ($arr1 as $value) {
            if (!in_array($value, $arr2)) {
                $arrDif[$i] = $value;
                $i++;
            }
        }
        foreach ($arr2 as $value1) {
            if (!in_array($value1, $arr1)) {
                $arrDif[$i] = $value1;
                $j++;
            }
        }
        print_r($arrDif);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array_Diff Manual</title>
</head>
<body>
<?php
arrayDiff([8, 9, 7, 2], [1, 2]);
?>
</body>
</html>

