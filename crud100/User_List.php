<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="../Jquery/jquery.js"></script>

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
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    <div class="search-container mb-3">
        <div class="input-group">
            <input type="text" class="form-control" id="search" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-primary" id="searchButton">Search</button>
            </div>
        </div>
    </div>
    <table class="table" id="resultTable">
        <thead>
        <tr>
            <th>Profile</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <!-- Initial data will be loaded here -->
        <?php
        @include '../config.php';

        // Fetch all data initially
        $sql = "SELECT id, name, email, Photo FROM user_form";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td><img src='../uploads/" . htmlspecialchars($row['Photo']) . "' alt='Profile Picture' width='50'></td>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-PfvNA1VtKcR02YypLfT0YHNaJQSA3xBB9G5KNmJ6I5UOWlP4nL1X2cGoAv4x3o6p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cY6tPnpG6aQ3aXT9UZN9IMzt+GRiwB/lJwDRR+x7X6I0QUf8zIdAvxAYP//Wo1s+" crossorigin="anonymous"></script>

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
