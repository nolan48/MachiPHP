<?php
require_once("../machi_db_connect.php");

$deal_status = $_POST['deal_status'];
$deal_id = $_POST['deal_id'];
// var_dump($deal_status);


$sql = "UPDATE deal SET deal_status = $deal_status WHERE deal_id = $deal_id";


if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

header("location:deal-list.php");