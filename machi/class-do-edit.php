<?php
require_once("../machi_db_connect.php"); //登入帳號

echo '<pre>';
print_r($_POST);
echo '</pre>';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $file = $_FILES['class_img'];


        // 取得副檔名
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        // 將檔案移動到目標目錄，並重新命名
        $target_dir = "../class_images/";
        $new_name = "c" . $class_id . "." . $ext;
        $target_file = $target_dir . $new_name;

        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            echo "圖片上傳成功！";
            // 更新 class 表的 class_img 欄位
            $sql = "UPDATE class SET class_img = '$new_name' WHERE class_id = $class_id";
            // 執行 SQL 更新語句，這裡假設您已經有一個名為 $conn 的資料庫連接


            if ($conn->query($sql)) {
                echo "資料庫更新成功！";
            } else {
                echo "資料庫更新失敗！";
            }
        } else {
            echo "圖片上傳失敗！";
        }
    }







if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_id = $_POST['class_id'];
    $class_name = $_POST['className'];
    $category = $_POST['category'];
    $teacher = $_POST['teacher'];
    $level = $_POST['level'];
    $location = $_POST['location'];
    $class_price = $_POST['price'];
    $enroll_start_date = $_POST['enrollstartDate'];
    $enroll_end_date = $_POST['enrollendDate'];
    $class_start_date = $_POST['classstartdate'];
    $class_end_date = $_POST['classenddate'];
    $class_intro = $_POST['intro'];


    // $sql = "UPDATE class SET class_name = '$class_name', subcategory_id_fk = '$category', teacher_id_fk = '$teacher', class_level = '$level', class_locations = '$location', class_price = '$class_price', class_enroll_start = '$enroll_start_date', class_enroll_end = '$enroll_end_date', class_coursedate_start = '$class_start_date', class_coursedate_end = '$class_end_date', class_intro = '$class_intro' WHERE class_id = $class_id";

    $sql = "UPDATE class SET class_name = '$class_name', subcategory_id_fk = '$category', teacher_id_fk = '$teacher', class_level = '$level', class_locations = '$location', class_price = '$class_price', class_enroll_start = '$enroll_start_date', class_enroll_end = '$enroll_end_date', class_coursedate_start = '$class_start_date', class_coursedate_end = '$class_end_date', class_intro = '$class_intro' WHERE class_id = $class_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

header("Location: class.php");
