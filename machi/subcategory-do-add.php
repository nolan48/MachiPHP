<!-- 這裡放使用者的資料 -->
<?php
require_once("../machi_db_connect.php");

if (isset($_POST['category_id'])) {
    echo "category_id 已被提交，其值為: " . $_POST['category_id'];
} else {
    echo "category_id 沒有被提交";
}
// 在此處處理表單提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單提交的子類別名稱
    $subcategory_name = $_POST['subcategory_name'];
    $category_id_fk = $_POST['category_id'];
    $seleted_name = $_POST['category_name'];
    echo $category_id_fk;
}

$sql_subcategory = "INSERT INTO subcategory (subcategory_name, subcategory_status, category_id_fk) VALUES ('$subcategory_name', '1', '$category_id_fk')";

    $conn->query($sql_subcategory);
    if ($conn->error) {
        die("Query failed: " . $conn->error);
    }
    

    $conn->close();


header("Location: category.php");

?>