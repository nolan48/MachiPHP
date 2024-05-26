<?php
require_once("../machi_db_connect.php");



if(!isset($_POST["product_name"])){
    echo "請循正常管道進入";
    exit;
}




$name=$_POST["product_name"];
$price=$_POST["product_price"];
$img=$_FILES["product_img"];
$product_description = $_POST['product_description'];
$category_id_fk = $_POST['category_id_fk'];
$subcategory_id_fk = $_POST['subcategory_id_fk'];

if (empty($name) || empty($price) || empty($img['name']) || $category_id_fk==0||$subcategory_id_fk==0) {
    echo "名稱、價格、圖片、類別為必填項目，請填寫完整資料。";

    header("location: product-add.php");
    exit;

}

$now=date('Y-m-d H:i:s');

// 查詢最後一筆資料的 ID
$result = $conn->query("SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1");

// 檢查查詢是否成功
if ($result && $result->num_rows > 0) {
    // 獲取最後一筆資料的 ID
    $last_id = $result->fetch_assoc()['product_id'];
    $now_id = $last_id + 1;
    echo "最後一筆資料的 ID 是 $last_id";
} else {
    echo "無法獲取最後一筆資料的 ID";
}

$sql="INSERT INTO product (product_id, product_name, product_price, product_createtime , product_updatetime , product_valid ,product_description , category_id_fk , subcategory_id_fk)
VALUES ('$now_id', '$name', '$price','$now', '$now', 1, '$product_description' , '$category_id_fk' , '$subcategory_id_fk')";

if($conn->query($sql)){
    echo "product資料新增完成";
    // $last_id = $conn->insert_id;
    // echo ", id 為 $last_id";
}else{
    echo "product資料新增錯誤: " . $conn->error; 
}

$product_img_id = $conn->insert_id;

// Get image extension
$image_extension = pathinfo($img['name'], PATHINFO_EXTENSION);

// Set the new image name with today's date and the count of today's uploaded images
$today_date = date('Y-m-d');

$new_image_name = $today_date . '_' . $product_img_id . '.' . $image_extension;

// Set the destination path for the new image
$destination = "../product_images/" . $new_image_name;

// Copy the image to the new destination
if (!move_uploaded_file($img['tmp_name'], $destination)) {
    echo "圖片上傳失敗";
    exit;
}


$sql2="INSERT INTO product_img (product_img_name,product_img_filename)
VALUES ('$name', '$new_image_name')";

if($conn->query($sql2)){
    echo "product_img資料新增完成";
    $product_img_id = $conn->insert_id; // 取得新插入的 product_img 的 ID
    
    $sql3 = "UPDATE product_img SET product_id_fk = '$product_img_id' WHERE product_img_id = '$product_img_id'";
    
    if($conn->query($sql3)){
        echo "product_img資料更新完成";
    }else{
        echo "product_img資料更新錯誤: " . $conn->error; 
    }
}else{
    echo "product_img資料新增錯誤: " . $conn->error; 
}



$conn->close();

// header("location: product-add.php");