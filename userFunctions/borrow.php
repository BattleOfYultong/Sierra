<?php
  

@include '../config.php';

session_start();

if(isset($_SESSION['email'])){
   $email = $_SESSION['email'];

   $sqlfetch = "SELECT *FROM user_form WHERE email = '$email'";
   $sqlResult = mysqli_query($conn, $sqlfetch);

   if($sqlResult && mysqli_num_rows($sqlResult) > 0){
      $row = mysqli_fetch_assoc($sqlResult);
       $id = $row['id'];
      $name = $row['name'];
      $photo = "uploads/".$row['Photo'];
   }

}
else{
    echo "<script>window.location.href='login_form.php?error_set=true'</script>";
}

 $Book = $_GET['BookID'];
 $UserID = $id;
 $status = "Borrowed";
    
    $sql = "INSERT INTO borrowed_tbl (BookID, UserID, Date, Status) VALUES ($Book, $UserID, NOW(), '$status' )";

    if($conn ->query($sql) === TRUE){
        echo "<script>window.location.href='../user_page.php';</script>";
    }
    else{
        echo "Error:" .$sql . "br" .$conn->error;
    }





    


   
    




