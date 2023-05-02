<?php

include '../db.php';

$sql = "SELECT DATE_FORMAT(created_datetime, '%m-%d-%Y') as month, COUNT(*) as count FROM post
WHERE created_datetime BETWEEN '2022-12-01 00:00:00' AND '2022-12-31 23:59:59' GROUP BY DATE_FORMAT(created_datetime, '%m-%d-%Y')";
$result = mysqli_query($conn, $sql);

$data = [
    '12-01-2022' => 0,
    '12-02-2022' => 0,
    '12-03-2022' => 0,
    '12-04-2022' => 0,
    '12-05-2022' => 0,
    '12-06-2022' => 0,
    '12-07-2022' => 0,
    '12-08-2022' => 0,
    '12-09-2022' => 0,
    '12-10-2022' => 0,
    '12-11-2022' => 0,
    '12-12-2022' => 0,
    '12-13-2022' => 0,
    '12-14-2022' => 0,
    '12-15-2022' => 0,
    '12-16-2022' => 0,
    '12-17-2022' => 0,
    '12-18-2022' => 0,
    '12-19-2022' => 0,
    '12-20-2022' => 0,
    '12-21-2022' => 0,
    '12-22-2022' => 0,
    '12-23-2022' => 0,
    '12-24-2022' => 0,
    '12-25-2022' => 0,
    '12-26-2022' => 0,
    '12-27-2022' => 0,
    '12-28-2022' => 0,
    '12-29-2022' => 0,
    '12-30-2022' => 0,
    '12-31-2022' => 0,
];

while ($row = mysqli_fetch_assoc($result)) {
    $month = $row['month'];
    $count = $row['count'];
    $data[$month] = $count;
}

$empty_months = [
    '12-01-2022' => 0,
    '12-02-2022' => 0,
    '12-03-2022' => 0,
    '12-04-2022' => 0,
    '12-05-2022' => 0,
    '12-06-2022' => 0,
    '12-07-2022' => 0,
    '12-08-2022' => 0,
    '12-09-2022' => 0,
    '12-10-2022' => 0,
    '12-11-2022' => 0,
    '12-12-2022' => 0,
    '12-13-2022' => 0,
    '12-14-2022' => 0,
    '12-15-2022' => 0,
    '12-16-2022' => 0,
    '12-17-2022' => 0,
    '12-18-2022' => 0,
    '12-19-2022' => 0,
    '12-20-2022' => 0,
    '12-21-2022' => 0,
    '12-22-2022' => 0,
    '12-23-2022' => 0,
    '12-24-2022' => 0,
    '12-25-2022' => 0,
    '12-26-2022' => 0,
    '12-27-2022' => 0,
    '12-28-2022' => 0,
    '12-29-2022' => 0,
    '12-30-2022' => 0,
    '12-31-2022' => 0,
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
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../libs/bootstrap.min.css">
</head>
<style>
  #active {
    background: #343232;
    color: #ffffff;
  }
</style>
<script src="../js/Chart.min.js"></script>
<script src="../libs/bootstrap.min.js"></script>
<body>
  <h4 class="mt-3 mb-3">Monthly Graph Design </h4>
  <hr>
  <div class="container-fluid w-75 mx-auto">
  <a href="../index.php" class="btn btn-dark">Back</a>
  <div class="float-end">
  <a href="_yearly.php" class=" btn btn-light border border-dark ">Yearly</a>
  <a href="_monthly.php" id="active" class="active btn btn-light border border-dark ">Monthly</a>
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
        label: "#Monthly Created Post",
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