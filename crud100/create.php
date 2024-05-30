<?php
    include "connection.php";
    if(isset($_POST['submit'])){
        $model = $_POST['model'];
        $brand = $_POST['brand'];
        $condition = $_POST['condition'];
        $q = " INSERT INTO `crud2`(`model`, `brand`, `condition`) VALUES ( '$model', '$brand', '$condition' )";

        $query = mysqli_query($conn,$q);
        if ($query) {
          $success = "Record updated successfully";
          header("Location: index.php");
          exit();
      } else {
          $error = "Error updating record: " . $conn->error;
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
 <title>Create</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">WAREHOUSE INVENTORY</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php"><span style="font-size:larger;">Add New</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 <div class="col-lg-6 m-auto">
 
 <form method="post">
    <br><br><div class="card">
        <div class="card-header bg-primary">
            <h1 class="text-white text-center">  REGISTER </h1>
        </div><br>

        <label> MODEL: </label>
        <input type="text" name="model" class="form-control"> <br>

        <label> BRAND: </label>
        <input type="text" name="brand" class="form-control"> <br>

        <label> CONDITION: </label>
        <input type="text" name="condition" class="form-control"> <br>

        <button class="btn btn-success"  type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

    </div>
</form>
</body>
</html>