<?php
require_once("../machi_db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sql = "SELECT teacher_id FROM teacher ORDER BY teacher_id DESC LIMIT 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // 輸出每行數據
    while ($row = $result->fetch_assoc()) {
      $last_teacher_id = $row["teacher_id"];
    }
  } else {
    echo "0 results";
  }

  $teacher_id = $last_teacher_id + 1;

  // 檢查是否有文件被上傳
  if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = "../teacher_images/"; // 指定上傳目錄
    $file_name = 't' . $teacher_id . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // 使用 "c" 加上 class_id 作為文件名
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
  //$teacherImage = $_POST['teacherImage'];
  $teacherName = $_POST['teacherName'];
  $teacherPhone = $_POST['teacherPhone'];
  $teacherEmail = $_POST['teacherEmail'];
  $teacherExpertise = $_POST['teacherExpertise'];
  $teacherIntro = $_POST['teacherIntro'];
  $teacherStatus = 1;

  echo $teacherName . $teacherPhone . $teacherEmail . $teacherExpertise . $teacherIntro . $teacherStatus;

  // // 檢查資料庫連線
  // if ($conn->connect_error) {
  //     die("連線失敗: " . $conn->connect_error);
  // }
  // echo "連線成功";

  $sql = "INSERT INTO teacher (teacher_name, teacher_phone, teacher_email, teacher_expertise, teacher_intro, teacher_status, teacher_img) VALUES ('$teacherName', '$teacherPhone', '$teacherEmail', '$teacherExpertise', '$teacherIntro', '$teacherStatus', '$file_name')";

  // 執行 SQL 查詢
  if ($conn->query($sql) === TRUE) {
    echo "資料已成功新增";
  } else {
    echo "錯誤: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  header("Location: teachers-list.php");
}
