<?php

$Entry_date = $_GET['Entry_date'];

$conn = Mysqli_connect("localhost", "root", "", "parking_project") or die("conection failed!");
$sql = "DELETE FROM update_info where Entry_date = '{$Entry_date}'";
$result = mysqli_query($conn, $sql) or die("query Failed");
header("location: http://localhost/parking-point/agent/record.php");
mysqli_close($conn);
