<?php
include "../connection.php";
if(isset($_GET['Borrowed_ID'])){
    $id = $_GET['Borrowed_ID'];
    $stmt = $conn->prepare("DELETE from `borrowed_tbl` WHERE Borrowed_ID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "<script>window.location.href='../userborrowed.php';</script>";
} else {
    header('Location:index.php');
    exit;
}
?>
