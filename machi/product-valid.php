<?php

if (!isset($_GET["product_id"])) {
  echo "請循正常管道進入本頁面";
  exit;
} 

require_once("../machi_db_connect.php");

$product_id = $_GET["product_id"];
$sql1="SElECT * FROM product WHERE product_id = $product_id";

$result = $conn->query($sql1);
$row = $result->fetch_assoc();

$product = $row;

if ($product["product_valid"] == 1) {
  $sql = "UPDATE product SET product_valid = 0 WHERE product_id = $product_id";
} else {
  $sql = "UPDATE product SET product_valid = 1 WHERE product_id = $product_id";
}

if ($conn->query($sql) == TRUE) {
  echo "修改成功";
} else {
  echo "修改資料錯誤: " . $conn->error;
}

$conn->close();

header("location: product-list.php");
?>