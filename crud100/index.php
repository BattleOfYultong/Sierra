<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Warehouse Inventory</title>
  
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Warehouse Inventory</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>

             <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="User_List.php">User-List</a>
            </li>
            
            <li class="nav-item">
              <a type="button" class="btn btn-primary nav-link active" href="create.php">Add New</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <div class="container my-4">
    <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>MODEL</th>
        <th>BRAND</th>
        <th>CONDITION</th>
        <th>JOINING DATE</th>
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
        <th>".$row['id']."</th>
        <td>".$row['model']."</td>
        <td>".$row['brand']."</td>
        <td>".$row['condition']."</td>
        <td>".$row['join_date']."</td>
        <td>
        <a  class='btn btn-success'  href='edit.php?id=$row[id];?>'>Edit</a>
        <a  class='btn btn-danger' href='delete.php?id=$row[id];?>'>Delete</a>
        </td>
      </tr>";
    }
 ?>
</tbody>
</table>
</div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    
  </body>
</html>