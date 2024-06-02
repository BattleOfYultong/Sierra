<?php
@include 'config.php';



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

$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT BookID, Book, Genre, Date FROM crud2 WHERE Book LIKE '%$search%' OR Genre LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookID = $row['BookID'];

        $sqlCheckBorrowed = "SELECT * FROM borrowed_tbl WHERE UserID = '$id' AND BookID = '$bookID'";
        $resultCheckBorrowed = mysqli_query($conn, $sqlCheckBorrowed);

        if(mysqli_num_rows($resultCheckBorrowed) > 0) {
            // Book is already borrowed by the user
            $buttonStatus = '<a class="btn btn-success" href="userFunctions/return.php?BookID=' . htmlspecialchars($row['BookID']) . '">Return</a>';
        } else {
            // Book is not borrowed by the user
            $buttonStatus = '<a class="btn btn-primary" href="userFunctions/borrow.php?BookID=' . htmlspecialchars($row['BookID']) . '">Borrow</a>';
        }

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['BookID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Book']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Genre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
        echo "<td>" . $buttonStatus . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
?>
