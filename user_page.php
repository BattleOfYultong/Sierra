<?php

@include 'config.php';

session_start();

if(isset($_SESSION['email'])){
   $email = $_SESSION['email'];

   $sqlfetch = "SELECT *FROM user_form WHERE email = '$email'";
   $sqlResult = mysqli_query($conn, $sqlfetch);

   if($sqlResult && mysqli_num_rows($sqlResult) > 0){
      $row = mysqli_fetch_assoc($sqlResult);
      $name = $row['name'];
      $photo = "uploads/".$row['Photo'];
   }

}
else{
    echo "<script>window.location.href='login_form.php?error_set=true'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <br>
      <div class="img-container">
      <img src="<?php echo "$photo" ?> " alt="">
      </div>
      <br>
      <h1>Welcome
         <span>
            <?php echo "$name" ?>
         </span>
      </h1>
      <p>this is an user page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>