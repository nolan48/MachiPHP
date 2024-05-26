<?php

require_once("../machi_db_connect.php");

$delete_subcategory = $_GET['subcategory_id'];

echo $delete_subcategory;

$sql = "UPDATE subcategory SET subcategory_status = 0 WHERE subcategory_id = $delete_subcategory";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

header("Location: category.php");
