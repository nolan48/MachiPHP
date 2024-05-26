<?php
require_once("../machi_db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 從 POST 請求中取得使用者資訊
    $user_id = $_POST['user_id'];


    $currentDateTime = date('Y-m-d H:i:s');
    // 準備 SQL 查詢
    // $sql = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email', user_address = '$user_address', user_notes = '$user_notes' WHERE user_id = $user_id";
    $sql = "DELETE FROM user WHERE user_id = $user_id";


    // 執行查詢
    if ($conn->query($sql) === TRUE) {
        echo "資料更新成功！";
    } else {
        echo "資料更新失敗！";
    }
}

// 重新導向回使用者列表
header("Location: user-list-banned-lily.php");
?>