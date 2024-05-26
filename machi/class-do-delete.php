<?php

require_once("../machi_db_connect.php");

$class_id = $_POST["class_id"];
$sql1="SELECT * FROM class WHERE class_id = $class_id";

$result = $conn->query($sql1);
$row = $result->fetch_assoc();

$class = $row;

$sql="DELETE FROM class WHERE class_id = $class_id";

if ($conn->query($sql) == TRUE) {
  echo "修改成功";
} else {
  echo "修改資料錯誤: " . $conn->error;
}

$conn->close();

header("location: class.php");
?>