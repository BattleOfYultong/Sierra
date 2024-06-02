<?php
include "connection.php";

if (isset($_POST['submit'])) {
    $book = $_POST['Book'];
    $genre = $_POST['Genre'];

    // SQL query with backticks around column names
    $q = "INSERT INTO `crud2` (`Book`, `Genre`, `Date`) VALUES ('$book', '$genre', NOW())";

    $query = mysqli_query($conn, $q);

    if ($query) {
        $success = "Record updated successfully";
        header("Location: index.php");
        exit();
    } else {
        // Improved error message
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create</title>
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
                    <a class="nav-link" href="create.php"><span style="font-size:larger;">Add New</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-lg-6 m-auto">
    <form method="post">
        <br><br>
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="text-white text-center">Add Book</h1>
            </div>
            <br>
            <label>Book Name</label>
            <input type="text" name="Book" class="form-control" required><br>

            <label>Genre</label>
            <select name="Genre" class="form-control mb-3" required>
                <option value="" disabled selected>Select Genre</option>
                <option value="Horror">Horror</option>
                <option value="Comedy">Comedy</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Documentary">Documentary</option>
                <option value="Romance">Romance</option>
                <option value="Religious">Religious</option>
            </select>

            <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
            <a class="btn btn-info" href="index.php">Cancel</a><br>
        </div>
    </form>
</div>
</body>
</html>
