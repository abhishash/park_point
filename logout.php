<?php
session_start();
if (isset($_SESSION["username"])) {
    session_destroy(); // Destroy the session itself
    // Redirect to the login page or homepage
    header("Location: /parking-point/login.php");
    exit();
}
?>