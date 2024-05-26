<?php
// 啟動 session
session_start();

// 刪除所有 session 變量
session_unset();

// 銷毀 session
session_destroy();

// 輸出所有 session 變量
print_r($_SESSION);
?>