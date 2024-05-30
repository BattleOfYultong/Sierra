<?php

session_start();
@include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];

    $sqlfetch = "SELECT *FROM user_form WHERE email = '$email'";
    $sqlfetchresult = mysqli_query($conn, $sqlfetch);

    if($sqlfetchresult && mysqli_num_rows($sqlfetchresult) > 0){
        $row = mysqli_fetch_assoc($sqlfetchresult);
        $name = $row['name'];
        $id = $row['id'];
    }
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        $sql = $conn->prepare("SELECT email FROM user_form WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            // Email found, send password reset link
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'xylosensei@gmail.com '; // Your Gmail email address
                $mail->Password = 'rlvhkfqmqozsgtiv'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('xylosensei@gmail.com', 'TNVS Sierra');
                $mail->addAddress($email); // Use the found email address
                $mail->addReplyTo('xylosensei@gmail.com','Email Verification TNVS');

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body = 'Here is your verification link: <a href="http://localhost/SIERRA/register_photo?token=' . urlencode(base64_encode($email)) . '&verifiedmessage=true">Verify Email</a>';

                $mail->send();
                 echo "<script>window.location.href='email_verification.php?register_success1=true';</script>";
            } catch (Exception $e) {
                $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Email not found";
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
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div id="bg" class="form-container">

    <form autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h3>Verify Email</h3>
      <input type="email" name="email" required placeholder="Enter Your Email">
     
      <input type="submit" name="submit" value="Register now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

                <?php
                    if (isset($_GET['register_success']) && $_GET['register_success'] == 'true') {
                            echo "<script>
                                    Swal.fire({
                                    title: 'Hello $name Please Verify your Email',
                                    text: 'Verify your Email',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    position: 'top',
                                 });
                                </script>";
                                }
                            ?>

                             <?php
                    if (isset($_GET['register_success1']) && $_GET['register_success1'] == 'true') {
                            echo "<script>
                                    Swal.fire({
                                    title: 'Check Your Email $email',
                                    text: 'Verify your Email',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    position: 'top',
                                 });
                                </script>";
                                }
                            ?>

</body>
</html>