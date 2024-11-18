<?php
  $token_number = $_GET['Token_number'];
  $conn = mysqli_connect("localhost", "root", "", "parking_project") or die("connection failed!");
  $sql = "SELECT * FROM vehicle_info where Token_number = '{$token_number}'";
  $result = mysqli_query($conn, $sql) or die("Query failed!");
  if(mysqli_num_rows($result)>0){
      while ($row = mysqli_fetch_assoc($result)){
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Parking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center" id="header">
                   <h1> Parking Lot Management System</h1>
                  
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center mb-3">
                    <h2 class="register">Update Exit Date Form</h2>
                    <form action="updatesave.php" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="owner">Vehicle Owner Name:</span>
                        </div>
                        <input type="text" name="owner_name" value="<?php echo $row['Owner_name']; ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Vehicle Name:</span>
                        </div>
                        <input type="text" name="vehicle_name" value="<?php echo $row['Vehicle_name']; ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Vehicle Number:</span>
                        </div>
                        <input type="text" name="vehicle_number" value="<?php echo $row['Vehicle_number']; ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Entry Date:</span>
                        </div>
                        <input type="text" name="entry_date" value="<?php echo $row['Entry_date']; ?>" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> Exit Date:</span>
                        </div>
                        <input type="datetime-local" name="exit_date" class="form-control">
                    </div>
                    
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Token Number:</span>
                        </div>
                        <input type="number" name="Token" value="<?php echo $row['Token_number']; ?>" class="form-control">
                    </div>
                   <input type="submit" class="btn btn-primary my-3">
                   </form>
                </div>
               
                <div class="col-md-6">
                    <img src="images/car.png" class="car" style="width: 650px; height: 250px; margin-top: 200px;" alt="car picture">
                </div>
            </div>
        </div> 
             
    </div>

</body>
</html>

    <?php

      }

  }else{
      echo "NO data Found!";
  }
?>
