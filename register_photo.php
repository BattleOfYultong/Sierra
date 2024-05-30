<?php

session_start();
@include 'config.php';

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $sqlfetch = "SELECT *FROM user_form WHERE email = '$email'";
    $sqlfetchresult = mysqli_query($conn, $sqlfetch);

    if($sqlfetchresult && mysqli_num_rows($sqlfetchresult) > 0){
        $row = mysqli_fetch_assoc($sqlfetchresult);
        $name = $row['name'];
        $id = $row['id'];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        
        if (!isset($_SESSION['email'])) {
            echo "Session not set";
            exit();
        }
    
        
       $email = $_SESSION['email'];
    
        
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["Photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        
        $check = getimagesize($_FILES["Photo"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
       
        if ($_FILES["Photo"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
       
        if (!in_array($imageFileType, array("jpg", "png", "jpeg", "gif"))) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
    
       
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
           
            $uniqueFilename = uniqid() . "." . $imageFileType;
            $targetFilePath = $targetDirectory . $uniqueFilename;
    
          
            if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $targetFilePath)) {
                
                $updateQuery = "UPDATE user_form SET Photo = '$uniqueFilename' WHERE email = '$email'";
                if (mysqli_query($conn, $updateQuery)) {
                    echo "<script>window.location.href='login_form?reg_success=true';</script>";
                    exit(); 
                    
                } else {
                    echo "Error updating record: " . mysqli_error($connections);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
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
   <script src="SweetAlert/sweetalert2.all.min.js"></script>
   <link rel="stylesheet" href="SweetAlert/sweetalert2.min.css">
   <title>Photo Registration</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div id="bg" class="form-container">

   <form action="register_photo.php" method="post" enctype="multipart/form-data">
      <h3>Setup Photo</h3>
         <div class="img-container">
            <img src="css/user_sample.png" id="imagedis"  alt="">
            <input name="Photo" id="imgup" type="file" required accept="image/*" onchange="previewPhoto()">

         </div>
     
      <input type="submit" name="submit" value="Submit" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

                <?php
                    if (isset($_GET['verifiedmessage']) && $_GET['verifiedmessage'] == 'true') {
                            echo "<script>
                                    Swal.fire({
                                    title: 'Almost There $name',
                                    text: 'Setup your Photo',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    position: 'top',
                                 });
                                </script>";
                                }
                            ?>


       <script>
        function previewPhoto() {
            const fileInput = document.getElementById('imgup');
            const previewImg = document.getElementById('imagedis');
            const file = fileInput.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '#';
                previewImg.style.display = 'none';
            }
        };
        
    </script>

</body>
</html>