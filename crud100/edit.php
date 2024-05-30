<?php
  include "connection.php";
  $id="";
  $model="";
  $brand="";
  $condition="";

  $error="";
  $success="";

  if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['id'])){
      header("location:crud100/index.php");
      exit;
    }
    $id = $_GET['id'];
    $stmt = $conn->prepare("select * from crud2 where id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    while(!$row){
      header("location:crud100/index.php");
      exit;
    }
    $model=$row["model"];
    $brand=$row["brand"];
    $condition=$row["condition"];

  }
  else{
    $id = $_POST["id"];
    $model=$_POST["model"];
    $brand=$_POST["brand"];
    $condition=$_POST["condition"];

    $sql = "update crud2 set model='$model', brand='$brand', `condition`='$condition' where id='$id'";
    $result = $conn->query($sql);
    if ($result) {
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
 <title>Edit</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">WAREHOUSE INVENTORY</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 <div class="col-lg-6 m-auto">
 
 <form method="post">
 
 <br><br><div class="card">
 
 <div class="card-header bg-warning">
 <h1 class="text-white text-center">  Update Form </h1>
 </div><br>

 <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

 <label> MODEL: </label>
 <input type="text" name="model" value="<?php echo $model; ?>" class="form-control"> <br>

 <label> BRAND: </label>
 <input type="text" name="brand" value="<?php echo $brand; ?>" class="form-control"> <br>

 <label> CONDITION: </label>
 <input type="text" name="condition" value="<?php echo $condition; ?>" class="form-control"> <br>

 <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
 <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>