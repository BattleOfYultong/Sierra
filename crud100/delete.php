<?php
    include "connection.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE from `crud2` WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header('Location:index.php');
    exit;
?>