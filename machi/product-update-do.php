<?php
require_once("../machi_db_connect.php");

if (!isset($_FILES['product_img']['name']) || !isset($_POST['product_id'])) {
    echo "請循正常管道進入本頁面";
    exit;
}

if (isset($_POST['product_img_check']) && $_POST['product_img_check'] == '1') {
    $sql = "SELECT product_img_filename FROM product_img WHERE product_img_id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_to_delete = "../product_images/" . $row['product_img_filename'];
        if (file_exists($file_to_delete)) {
            unlink($file_to_delete);
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $image_extension = pathinfo($_FILES['product_img']['name'], PATHINFO_EXTENSION);
    $today_date = date('Y-m-d');
    $new_image_name = $today_date . "_" . $product_id . "." . $image_extension;
    $destination = "../product_images/" . $new_image_name;

    if (move_uploaded_file($_FILES['product_img']['tmp_name'], $destination)) {
        $sql = "UPDATE product_img SET product_img_filename = '$new_image_name', product_img_id = $product_id, product_id_fk = $product_id WHERE product_img_id = $product_id";
        if ($conn->query($sql)) {
            echo "資料庫更新成功！";
        } else {
            echo "資料庫更新失敗！";
        }
    } else {
        echo "圖片複製失敗";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 從 POST 請求中取得使用者資訊
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $category_id_fk = $_POST['category_id_fk'];
    $subcategory_id_fk = $_POST['subcategory_id_fk'];

    $currentDateTime = date('Y-m-d H:i:s');

    // 準備 SQL 查詢
    // $sql = "UPDATE user SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email', user_address = '$user_address', user_notes = '$user_notes' WHERE user_id = $user_id";
    $sql = "UPDATE product SET product_id = '$product_id', product_name = '$product_name', product_price = '$product_price', product_description = '$product_description',product_updatetime = '$currentDateTime' , category_id_fk = '$category_id_fk', subcategory_id_fk = '$subcategory_id_fk' WHERE product_id = $product_id";


    // 執行查詢
    if ($conn->query($sql) === TRUE) {
        echo "資料更新成功！";
    } else {
        echo "資料更新失敗！";
    }
}


$conn->close();
//回使用者詳細資料頁
header("Location: http://localhost/team02/machi/product_edit.php?id=$product_id");
