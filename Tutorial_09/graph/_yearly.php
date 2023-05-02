<?php

include '../db.php';

$sql = "SELECT MONTH(created_datetime) as month, COUNT(*) as count FROM post
WHERE YEAR(created_datetime) = 2022 GROUP BY MONTH(created_datetime)";
$result = mysqli_query($conn, $sql);

$data = [
    'January' => 0,
    'February' => 0,
    'March' => 0,
    'April' => 0,
    'May' => 0,
    'June' => 0,
    'July' => 0,
    'August' => 0,
    'September' => 0,
    'October' => 0,
    'November' => 0,
    'December' => 0,
];

while ($row = mysqli_fetch_assoc($result)) {
    $month = $row['month'];
    $count = $row['count'];
    $month_name = date('F', mktime(0, 0, 0, $month, 1));
    $data[$month_name] = $count;
}

$empty_months = [
    'January' => 0,
    'February' => 0,
    'March' => 0,
    'April' => 0,
    'May' => 0,
    'June' => 0,
    'July' => 0,
    'August' => 0,
    'September' => 0,
    'October' => 0,
    'November' => 0,
    'December' => 0,
];

$merged_data = array_merge($empty_months, $data);

$json_data = json_encode($merged_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../libs/bootstrap.min.css">
</head>
<style>
  #active {
    background: #343232;
    color: #ffffff;
  }
</style>
<script src="../js/Chart.min.js"></script>
<body>

<h4 class="mt-3 mb-3">Yearly Graph Design </h4>
  <hr>
  <div class="container-fluid w-75 mx-auto">
  <a href="../index.php" class="btn btn-dark">Back</a>
  <div class="float-end">
  <a href="_yearly.php" id="active" class=" btn btn-light border border-dark ">Yearly</a>
  <a href="_monthly.php"  class=" btn btn-light border border-dark ">Monthly</a>
  <a href="_weekly.php" class=" btn btn-light border border-dark">Weekly</a>
  </div>
  <canvas id="myChart" width="100" height="50" class="mt-5 w-75 mx-auto"></canvas>
  </div>
<script>
var ctx = document.getElementById("myChart").getContext("2d");
var data = <?php echo json_encode(array_values($merged_data)); ?>;
var labels = <?php echo json_encode(array_keys($merged_data)); ?>;

var myChart = new Chart(ctx, {
        type: "bar",
            data: {
                labels: labels ,
                datasets: [{
                    label: "#Yearly Created Post",
                    data: data,
                    backgroundColor: "#49e2ff",
                    borderColor: "#49e2ff",
                    borderWidth: 1
                }]
             },
        options: {
            scales: {
                yAxes: [{
                ticks: {
                beginAtZero: true
                }
                }]
            }
            }
        });
</script>
</body>
</html>