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
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="Jquery/jquery.js"></script>

    <title>Library System</title>
  
  </head>
  <style>
    .create{
      margin-left: 5px;
    }
    #userimg{
      width: 5rem;
      height: 5rem;
      border-radius: 50%;
      border: 2px solid black;
    }
  </style>

  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Library System</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>

            

             <li class="nav-item ">
              <a type="button" class="btn btn-danger nav-link active" href="logout.php">Log out</a>
            </li>
            <br>
          
            
          </ul>
        </div>
      </div>
    </nav>
    <div class="container my-4">
      <div class="d-flex  align-items-center gap-2 mb-2">
         <img src="<?php echo "$photo" ?>" id="userimg" alt="">
         <h2>Welcome <?php echo "$name" ?></h2>
      </div>
        <h2>Available Books</h2>
    <div class="search-container mb-3">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-primary" id="searchButton">Search</button>
            </div>
        </div>
    </div>




    <div class="container my-4">
    
    <table class="table" id="resultTable">
    <thead>
      <tr>
        <th>Book ID</th>
        <th>Book Name</th>
        <th>Genre</th>
        <th>Date</th>
        <th>ACTIONS</th>
      </tr>
      </thead>
<tbody>
  <?php

    include "config.php";
    $sql = "select * from crud2";
    $result = $conn->query($sql);
    if(!$result){
      die("Invalid query!");
    }
    
    while($row = $result->fetch_assoc()){
    
    
    $bookID = $row['BookID'];

    
    $sqlCheckBorrowed = "SELECT * FROM borrowed_tbl WHERE UserID = '$id' AND BookID = '$bookID'";
    $resultCheckBorrowed = mysqli_query($conn, $sqlCheckBorrowed);

    if(mysqli_num_rows($resultCheckBorrowed) > 0) {

        
        $buttonStatus = '<a class="btn btn-success" href="userFunctions/return.php?BookID=' . $bookID . '">Return</a>';
    } else {
        
        $buttonStatus = '<a class="btn btn-primary" href="userFunctions/borrow.php?BookID=' . $bookID . '">Borrow</a>';
    }

    echo "<tr>
        <th>".$row['BookID']."</th>
        <td>".$row['Book']."</td>
        <td>".$row['Genre']."</td>
        <td>".$row['Date']."</td>
        <td>".$buttonStatus."</td>
      </tr>";
}
?>
</tbody>
</table>
</div>
   <script>
    $(document).ready(function() {
        $('#searchButton').on('click', function() {
            var search = $('#search').val();
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: { search: search },
                success: function(response) {
                    $('#resultTable tbody').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });

        $('#search').on('keypress', function(e) {
            if (e.which === 13) { // Enter key pressed
                $('#searchButton').click();
            }
        });
    });
</script>
    
  </body>
</html>
