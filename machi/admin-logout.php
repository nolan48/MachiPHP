<?php
// 啟動 session
session_start();


// 處理登出請求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 移除 session 中的用戶名
    unset($_SESSION['machi-user_email']);

    // 重定向到登入頁面
    header('Location: admin-login.php');
    exit;
}
?>

