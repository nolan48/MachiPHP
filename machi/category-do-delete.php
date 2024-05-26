<?php
require_once("../machi_db_connect.php");

$delete_category = $_POST['delete_category'];

// echo  $delete_category;

$sql = "UPDATE category SET category_status = 0 WHERE category_id = $delete_category";


if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

header("Location: category.php");

?>