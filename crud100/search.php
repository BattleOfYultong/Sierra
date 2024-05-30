<?php
@include '../config.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';


$sql = "SELECT id, model, brand, 'condition', join_date FROM crud2 WHERE model LIKE '%$search%'  OR brand LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
       
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['model']) . "</td>";
        echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
        echo "<td>" . htmlspecialchars($row['condition']) . "</td>";
        echo "<td>" . htmlspecialchars($row['join_date']) . "</td>";
        echo "<td>
                <a class='btn btn-success' href='edit.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a>
                <a class='btn btn-danger' href='delete.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No results found</td></tr>";
}
?>
