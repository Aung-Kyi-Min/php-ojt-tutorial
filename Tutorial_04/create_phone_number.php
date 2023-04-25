<?php
function createPhoneNumber($numberArray)
{
    $phone_number = implode('', $numberArray);
    $formatted_number = '(' . substr($phone_number, 0, 3) . ') ' . substr($phone_number, 3, 3) . '-' . substr($phone_number, 6);
    echo $formatted_number;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create_Phone_Number</title>
</head>
<body>
    <?php
createPhoneNumber([5, 7, 8, 6, 7, 8, 9, 0, 5, 5, 8, 9, 7]);
?>
</body>
</html>