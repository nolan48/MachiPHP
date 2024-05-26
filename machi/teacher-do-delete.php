<?php

require_once("../machi_db_connect.php");

// 確保有收到有效的教師 ID
if (isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    $sql = "UPDATE teacher SET teacher_status = 0 WHERE teacher_id = $teacher_id";

    mysqli_query($conn, $sql);
}

// 關閉資料庫連線
mysqli_close($conn);

// 重新導向回講師列表
header("Location: teachers-list.php");
