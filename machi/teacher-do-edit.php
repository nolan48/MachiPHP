<?php
require_once("../machi_db_connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['teacher_img']) && isset($_POST['teacher_id'])) {
    $file = $_FILES['teacher_img'];
    $teacher_id = $_POST['teacher_id'];



    // 檢查檔案類型
    if (isset($file['type']) && !empty($file['type']) && !in_array($file['type'], ['image/jpeg', 'image/png'])) {
        echo "只允許上傳 JPEG、PNG 的圖片！";
        exit;
    }

    // 取得副檔名
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    // 將檔案移動到目標目錄，並重新命名
    $target_dir = "../teacher_images/";
    $new_name = "t" . $teacher_id . "." . $ext;
    $target_file = $target_dir . $new_name;
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        echo "圖片上傳成功！";

        // 更新資料庫
        $sql = "UPDATE teacher SET teacher_img = '$new_name' WHERE teacher_id = $teacher_id";
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

    // 獲取其他表單數據
    $teacherName = $_POST["teacherName"];
    $teacherPhone = $_POST["teacherPhone"];
    $teacherEmail = $_POST["teacherEmail"];
    $teacherExpertise = $_POST["teacherExpertise"];
    $teacherIntro = $_POST["teacherIntro"];


    // 準備 SQL 查詢
    // $sql = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email', user_address = '$user_address', user_notes = '$user_notes' WHERE user_id = $user_id";
    $sql = "UPDATE teacher SET teacher_name = '$teacherName', teacher_phone = '$teacherPhone', teacher_email = '$teacherEmail', teacher_expertise = '$teacherExpertise', teacher_intro = '$teacherIntro' WHERE teacher_id = $teacher_id";


    // 執行查詢
    if ($conn->query($sql) === TRUE) {
        echo "資料更新成功！";
    } else {
        echo "資料更新失敗！";
    }
}


$conn->close();
//回使用者詳細資料頁
header("Location: teacher-details.php?id=$teacher_id");
