<?php
include "connection.php";

// Initialize variables
$BookID = "";
$Book = "";
$Genre = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['BookID'])) {
        header("location:crud100/index.php");
        exit;
    }
    $id = $_GET['BookID'];
    $stmt = $conn->prepare("SELECT * FROM crud2 WHERE BookID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (!$row) {
        header("location:crud100/index.php");
        exit;
    }
    $BookID = $row["BookID"];
    $Book = $row["Book"];
    $Genre = $row["Genre"];
} else {
    $BookID = $_POST["BookID"];
    $Book = $_POST["Book"];
    $Genre = $_POST["Genre"];

    $sql = "UPDATE crud2 SET Book='$Book', Genre='$Genre' WHERE BookID='$BookID'";
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
    <title>Edit Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Library System</a>
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
        <br><br>
        <div class="card">
            <div class="card-header bg-warning">
                <h1 class="text-white text-center">Update Form</h1>
            </div><br>

            <input type="hidden" name="BookID" value="<?php echo $BookID; ?>" class="form-control"> <br>

            <label>Book:</label>
            <input type="text" name="Book" value="<?php echo $Book; ?>" class="form-control"> <br>

            <label>Genre:</label>
            <select name="Genre" class="form-control mb-3" required>
                <option value="<?php echo $Genre; ?>"><?php echo $Genre; ?></option>
                <option value="Horror">Horror</option>
                <option value="Comedy">Comedy</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Documentary">Documentary</option>
                <option value="Romance">Romance</option>
                <option value="Religious">Religious</option>
            </select>

            <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
            <a class="btn btn-info" type="submit" name="cancel" href="index.php">Cancel</a><br>
        </div>
    </form>
</div>
</body>
</html>
