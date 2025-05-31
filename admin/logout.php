<?php
session_start();
session_destroy();
header("location:http://localhost/parking-point/admin/login.php");

?>