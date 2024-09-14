<?php

  $owner_name = $_POST['owner_name'];
  $vehicle_name = $_POST['vehicle_name'];
  $vehicle_number = $_POST['vehicle_number'];
  $entry_date = $_POST['entry_date'];
  $token_number = $_POST['Token'];
  $conn = mysqli_connect("localhost", "root", "", "parking_project") or die("conection failed!");
  $sql = "INSERT INTO vehicle_info(Owner_name, Vehicle_name, Vehicle_number, Entry_date, Token_number) VALUES('{$owner_name}','{$vehicle_name}','{$vehicle_number}','{$entry_date}','{$token_number}')";
  $result = mysqli_query($conn, $sql) or die("query Failed");
  header("location: http://localhost/project/index.php");
  mysqli_close($conn);
?>