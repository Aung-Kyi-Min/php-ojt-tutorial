<?php

include '../db.php';
$sql = "SELECT DAY(created_datetime) as week, COUNT(*) as count FROM post
 WHERE created_datetime BETWEEN '2023-04-03 00:00:00' AND '2023-04-09 23:59:59'
 GROUP BY DAY(created_datetime)
 ORDER BY DAY(created_datetime) DESC";
$result = mysqli_query($conn, $sql);
$data = [
    'Monday' => 0,
    'Tuesday' => 0,
    'Wednesday' => 0,
    'Thursday' => 0,
    'Friday' => 0,
    'Saturday' => 0,
    'Sunday' => 0,
];

while ($row = mysqli_fetch_assoc($result)) {
    $week = $row['week'];
    $count = $row['count'];

    $week_name = date('l', mktime(0, 0, 0, 0, $week));
    $data[$week_name] = $count;
}

$empty_weeks = [
    'Monday' => 0,
    'Tuesday' => 0,
    'Wednesday' => 0,
    'Thursday' => 0,
    'Friday' => 0,
    'Saturday' => 0,
    'Sunday' => 0,
];

$merged_data = array_merge($empty_weeks, $data);
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
  <style>
  #active {
    background: #343232;
    color: #ffffff;
  }
</style>
</head>
<script src="../js/Chart.min.js"></script>
<body>
<h4 class="mt-3 mb-3">Weekly Graph Design </h4>
  <hr>
  <div class="container-fluid w-75 mx-auto">
  <a href="../index.php" class="btn btn-dark">Back</a>
  <div class="float-end">
  <a href="_yearly.php"  class=" btn btn-light border border-dark ">Yearly</a>
  <a href="_monthly.php"  class=" btn btn-light border border-dark ">Monthly</a>
  <a href="_weekly.php" id="active" class=" btn btn-light border border-dark">Weekly</a>
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
          label: "#Weekly Created Post",
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