<?php
    include "connection.php";
    if(isset($_GET['BookID'])){
        $id = $_GET['BookID'];
        $stmt = $conn->prepare("DELETE from `crud2` WHERE BookID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header('Location:index.php');
    exit;
?>