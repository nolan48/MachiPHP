<?php
require_once("../machi_db_connect.php");



if(!isset($_POST["coupon_name"])){
    echo "請循正常管道進入";
    exit;
}

$name=$_POST["coupon_name"];
$type=$_POST["coupon_type"];
$discount=$_POST["coupon_discount"];
$purchase=$_POST["coupon_purchase"];
$starttime=$_POST["coupon_starttime"];
$limittime=$_POST["coupon_limittime"];
$count=$_POST["coupon_count"];
$description=$_POST["coupon_description"];

$now=date('Y-m-d H:i:s');

$sql="INSERT INTO coupon (coupon_name, coupon_type, coupon_discount , coupon_purchase , coupon_starttime, coupon_limittime,coupon_count,coupon_description,coupon_createtime)
VALUES ('$name', '$type', '$discount','$purchase','$starttime','$limittime','$count', '$description', '$now')";

if($conn->query($sql)){
    echo "coupon資料新增完成";
    // $last_id = $conn->insert_id;
    // echo ", id 為 $last_id";
}else{
    echo "coupon資料新增錯誤: " . $conn->error; 
}

$conn->close();

header("location: coupon-list.php");
?>