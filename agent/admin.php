<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:http://localhost/parking-point/agent/login.php");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Car Parking</title>
        <link rel="stylesheet" href="admin.css">
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center" id="header">
                    <h1> Parking Lot Management System</h1>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="record.php">All Records</a></li>
                        <li><a href="admin.php">Make Parking Admin</a></li>
                        <li><a style="color: orange;" href="logout.php">Logout <?php echo $_SESSION['username']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="form">
            <div class="admin-form">
                <h1>Admin Form</h1>
                <form action="registration.php" method="post">
                    <label for="">Username:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="username" placeholder="Username"> <br> <br>
                    <label for="">Password:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="password" placeholder="Password"> <br> <br>
                    <label for="">Confirm Password:</label>&nbsp;&nbsp;&nbsp;
                    <input type="text" name="co-password" placeholder="Confirm Password"> <br> <br>
                    <input type="submit" class="submit" value="submit">
                </form>
            </div>
        </div>

    </body>

    </html>
<?php
}
?>