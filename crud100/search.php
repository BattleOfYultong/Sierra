<?php
@include '../config.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';


$sql = "SELECT BookID, Book, Genre, Date FROM crud2 WHERE Book LIKE '%$search%'  OR Genre LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
       
        echo "<td>" . htmlspecialchars($row['BookID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Book']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Genre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
       
        echo "<td>
                <a class='btn btn-success' href='edit.php?BookID=" . htmlspecialchars($row['BookID']) . "'>Edit</a>
                <a class='btn btn-danger' href='delete.php?BookID=" . htmlspecialchars($row['BookID']) . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No results found</td></tr>";
}
?>
