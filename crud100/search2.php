<?php
@include '../config.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';

$sql = "SELECT c.BookID, c.Book, c.Genre, c.Date, u.name AS BorrowerName, b.Status
        FROM crud2 c
        INNER JOIN borrowed_tbl b ON c.BookID = b.BookID
        INNER JOIN user_form u ON b.UserID = u.id
        WHERE c.Book LIKE '%$search%' OR c.Genre LIKE '%$search%' OR b.Status LIKE '%$search%' OR u.name LIKE '%$search%'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['BookID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Book']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Genre']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['BorrowerName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
        echo "<td>
                <a class='btn btn-danger' href='delete.php?BookID=" . htmlspecialchars($row['BookID']) . "'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No results found</td></tr>";
}
?>
