<?php

require_once("../machi_db_connect.php");

$coupon_id = $_POST["coupon_id"];
$sql1="SELECT * FROM coupon WHERE coupon_id = $coupon_id";

$result = $conn->query($sql1);
$row = $result->fetch_assoc();

$coupon = $row;

$sql="DELETE FROM coupon WHERE coupon_id = $coupon_id";

if ($conn->query($sql) == TRUE) {
  echo "刪除成功";
} else {
  echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: coupon-list.php");
?>