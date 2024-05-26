<?php
// 啟動 session
session_start();

require_once("../machi_db_connect.php");


// 處理表單提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $useremail = mysqli_real_escape_string($conn, $_POST['useremail']);
    $password = $_POST['password'];

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    // 從資料庫獲取用戶名對應的密碼
    $result = $conn->query("SELECT user_password FROM user WHERE user_email = '$useremail'");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // 檢查用戶名和密碼是否正確
        if ($password === $row['user_password']) {
            // 如果正確，則將用戶名存儲到 session 中，並重定向到主頁面
            $_SESSION['machi-user_email'] = $useremail;
            // 清除錯誤訊息的 SESSION
            unset($_SESSION['error']);
            header('Location: home-page.php');
            exit;
        }
    }

    // 如果不正確，則顯示一個錯誤消息
    $error = 'Invalid username or password';
    $_SESSION['error'] = $error;
}




// 檢查是否已經登入
if (isset($_SESSION['machi-user_email'])) {
    header('Location: home-page.php');
    exit;
} else {
    header('Location: admin-login.php');
    exit;
}
