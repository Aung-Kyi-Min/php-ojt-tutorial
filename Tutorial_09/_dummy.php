<?php
include 'db.php';
$time[] = array();
$sql = "SELECT * FROM post";
$result = mysqli_query($conn, $sql);
$row = mysqli_num_rows($result);

if ($row <= 300) {
    for ($i = 1; $i <= 300; $i++) {
        $title = "Posting " . $i;
        $content = "$i lore msdfmsk dkfo spodfn wskdfj pwoefj wsfo wdefop opwefnhowe f wedkjf wsf";
        $publish = "1";
        $time[] = date('Y-m-d ', strtotime('-' . $i . ' days'));

        $sql = "INSERT INTO post(title,content,is_published,created_datetime) VALUES ('$title' , '$content' , '$publish','$time[$i]')";
        $sql_run = mysqli_query($conn, $sql);
    }
} else {
    echo "Already Have above 300 rows in database...";
}

if ($sql_run) {
    echo "Records  successfully";
}
