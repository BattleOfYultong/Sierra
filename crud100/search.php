<?php
@include '../config.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';


$sql = "SELECT id, name, email, Photo FROM user_form WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
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
