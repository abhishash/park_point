<?php
session_start();
$name = $_POST["username"];
$pass = $_POST["password"];
$conn = mysqli_connect("localhost", "root", "", "parking_project") or die("Connectiion failed!");
$sql = "SELECT * FROM admin_info where username = '{$name}' && password = '{$pass}'";
$result = mysqli_query($conn, $sql) or die("query failed!");
$num = mysqli_num_rows($result);
if ($num == 1) {
    $_SESSION["username"] = $name;
    header("location:http://localhost/project/index.php");
} else {
    header("location:http://localhost/project/login.php");
}
