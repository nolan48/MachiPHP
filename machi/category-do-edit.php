<?php
require_once("../machi_db_connect.php");


// category-do-edit.php
// 獲取表單提交的商品類別和子類別值
$category_name = $_POST['category_name'];
$subcategory_name = $_POST['subcategory_name'];
$subcategory_id = $_POST['subcategory_id'];
$category_id = $_POST['category_id'];


// 假設您有一個名為 categories 的資料表，並且有一個用於區分記錄的 ID 欄位
// 如果您的資料表結構不同，請相應地修改下面的 SQL 語句
// 生成 SQL 語句來更新商品類別和子類別

$sql = "UPDATE category SET category_name = '$category_name' WHERE category_id = $category_id";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


for ($i = 0; $i < count($subcategory_id); $i++) {
    $sql = "UPDATE subcategory SET subcategory_name = '$subcategory_name[$i]' WHERE subcategory_id = $subcategory_id[$i]";
    if ($conn->query($sql) !== TRUE) {
        echo "Error updating subcategory: " . $conn->error;
    }
}

    $conn->close();
    header("Location: category.php");
?>