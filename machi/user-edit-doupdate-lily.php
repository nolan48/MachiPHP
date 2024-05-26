<?php
require_once("../machi_db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['user_img']) && isset($_POST['user_id'])) {
    $file = $_FILES['user_img'];
    $user_id = $_POST['user_id'];



    // 檢查檔案類型
    if (isset($file['type']) && !empty($file['type']) && !in_array($file['type'], ['image/jpeg', 'image/png'])) {
        echo "只允許上傳 JPEG、PNG 的圖片！";
        exit;
    }

    // 取得副檔名
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    // 將檔案移動到目標目錄，並重新命名
    $target_dir = "../user_images/";
    $new_name = "u" . $user_id . "." . $ext;
    $target_file = $target_dir . $new_name;
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        echo "圖片上傳成功！";

        // 更新資料庫
        $sql = "UPDATE user SET user_img = '$new_name' WHERE user_id = $user_id";
        if ($conn->query($sql)) {
            echo "資料庫更新成功！";
        } else {
            echo "資料庫更新失敗！";
        }
    } else {
        echo "圖片上傳失敗！";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 從 POST 請求中取得使用者資訊
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_phone'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_notes = $_POST['user_notes'];

    $currentDateTime = date('Y-m-d H:i:s');

    // 準備 SQL 查詢
    // $sql = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email', user_address = '$user_address', user_notes = '$user_notes' WHERE user_id = $user_id";
    $sql = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email', user_address = '$user_address', user_notes = '$user_notes', user_updatetime = '$currentDateTime' WHERE user_id = $user_id";


    // 執行查詢
    if ($conn->query($sql) === TRUE) {
        echo "資料更新成功！";
    } else {
        echo "資料更新失敗！";
    }
}


$conn->close();
//回使用者詳細資料頁
header("Location: user-edit-finished-lily.php?id=$user_id");
