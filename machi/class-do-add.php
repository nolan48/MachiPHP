<?php
require_once("../machi_db_connect.php");

echo '<pre>';
print_r($_POST);
echo '</pre>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "SELECT class_id FROM class ORDER BY class_id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 輸出每行數據
        while ($row = $result->fetch_assoc()) {
            $last_class_id = $row["class_id"];
        }
    } else {
        echo "0 results";
    }

    $class_id = $last_class_id + 1;

    // 檢查是否有文件被上傳
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = "../class_images/"; // 指定上傳目錄
        $file_name = 'c' . $class_id . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // 使用 "c" 加上 class_id 作為文件名
        $upload_file = $upload_dir . $file_name;

        // 將文件移動到上傳目錄
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            echo "File is valid, and was successfully uploaded.\n";
            // 更新 class 表的 class_img 欄位
            // 執行 SQL 更新語句，這裡假設您已經有一個名為 $conn 的資料庫連接
        } else {
            echo "Possible file upload attack!\n";
        }
    } else {
        echo "No file uploaded or upload error.\n";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 從 POST 請求中獲取表單數據
    $className = $_POST['className'];
    $classCategory = $_POST['category'];
    $classLevel = $_POST['level'];
    $teacherName = $_POST['teacher'];
    $classLocation = $_POST['location'];
    $price = $_POST['price'];
    //$classImage = $_FILES['image'];

    $classEnrollStart = $_POST['enrollstartDate'];
    $classEnrollEnd = $_POST['enrollendDate'];
    $classStartDate = $_POST['classstartdate'];
    $classEndDate = $_POST['classenddate'];


    $classDescription = $_POST['intro'];
    echo $className . $classCategory . $classLevel . $teacherName . $classLocation . $price . $classEnrollStart . $classEnrollEnd . $classStartDate . $classEndDate . $classDescription;

    $sql = "SELECT teacher_id FROM teacher WHERE teacher_name = '$teacherName' AND teacher_status = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $teacher_id = $row['teacher_id'];
        }
    } else {
        echo "0 結果";
    }
    $sql = "SELECT subcategory_id FROM subcategory WHERE subcategory_name = '$classCategory' AND subcategory_status = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $subcategory_id = $row['subcategory_id'];
        }
    } else {
        echo "0 結果";
    }
    // 建立 SQL 插入查詢
    $sql = "INSERT INTO class (class_name, subcategory_id_fk, class_level, teacher_id_fk, class_locations, class_price, class_intro, class_status, class_enroll_start, class_enroll_end, class_coursedate_start, class_coursedate_end, class_img)
    VALUES ('$className', '$subcategory_id', '$classLevel', '$teacher_id', '$classLocation', $price, '$classDescription', '1', '$classEnrollStart', '$classEnrollEnd', '$classStartDate', '$classEndDate', '$file_name')";

    // 執行 SQL 查詢
    if ($conn->query($sql) === TRUE) {
        echo "新紀錄已成功新增";
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: class.php");
}
