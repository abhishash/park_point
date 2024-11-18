<?php
session_start();
echo $_SESSION["user_type"];
if (!isset($_SESSION["username"]) || $_SESSION["user_type"] !== 'admin') {
    header("Location: http://localhost/parking-point/admin/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>hii admin login page</h1>
</body>

</html>