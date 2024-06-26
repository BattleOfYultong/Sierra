<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../Jquery/jquery.js"></script>

    <title>Library System</title>
  
  </head>
  <style>
    .create{
      margin-left: 5px;
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

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="userborrowed.php">Borrowed Books</a>
              </li>

            

             <li class="nav-item ">
              <a type="button" class="btn btn-danger nav-link active" href="../logout.php">Log out</a>
            </li>
            <br>
          <li class="nav-item">
            <a type="button" class="btn btn-primary nav-link active create" href="create.php">Add New</a>
          </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <div class="container my-4">
        <h2>Books</h2>
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

    include "connection.php";
    $sql = "select * from crud2";
    $result = $conn->query($sql);
    if(!$result){
      die("Invalid query!");
    }
    while($row=$result->fetch_assoc()){
      echo "<tr>
        <th>".$row['BookID']."</th>
        <td>".$row['Book']."</td>
        <td>".$row['Genre']."</td>
        <td>".$row['Date']."</td>
        
        <td>
        <a  class='btn btn-success'  href='edit.php?BookID=$row[BookID];?>'>Edit</a>
        <a  class='btn btn-danger' href='delete.php?BookID=$row[BookID];?>'>Delete</a>
        </td>
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
