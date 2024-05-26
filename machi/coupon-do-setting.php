<?php
require_once("../machi_db_connect.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['coupon_id'])) {
   

    $coupon_id = $_POST['coupon_id'];

  

}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 從 POST 請求中取得使用者資訊
    $coupon_id = $_POST['coupon_id'];
    $coupon_name = $_POST['coupon_name'];
    $coupon_type = $_POST['coupon_type'];
    $coupon_type = $_POST['coupon_type'];
    $coupon_discount = $_POST['coupon_discount'];
    $coupon_starttime = $_POST['coupon_starttime'];
    $coupon_limittime = $_POST['coupon_limittime'];
    $coupon_count = $_POST['coupon_count'];
    $coupon_description = $_POST['coupon_description'];

    $currentDateTime = date('Y-m-d H:i:s');

    // 準備 SQL 查詢
    // $sql = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email', user_address = '$user_address', user_notes = '$user_notes' WHERE user_id = $user_id";
    $sql = "UPDATE coupon SET coupon_id = '$coupon_id', coupon_name = '$coupon_name', coupon_type = '$coupon_type', coupon_discount = '$coupon_discount', coupon_starttime = '$coupon_starttime' , coupon_limittime = '$coupon_limittime' , coupon_count = '$coupon_count' , coupon_description = '$coupon_description'         WHERE coupon_id = $coupon_id" ;


    // 執行查詢
    if ($conn->query($sql) === TRUE) {
        echo "資料更新成功！";
    } else {
        echo "資料更新失敗！";
    }
}


$conn->close();
//回使用者詳細資料頁
header("Location: http://localhost/team02/machi/coupon-detail.php?id=$coupon_id");
?>