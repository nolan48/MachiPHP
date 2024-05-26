<?php
// 啟動 session
session_start();

// 檢查所有 session 變量
foreach ($_SESSION as $key => $value) {
    echo "Key: $key; Value: $value<br>";
}
?>