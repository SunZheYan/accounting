<?php
$conn=require_once "config.php";

// 獲取提交的數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 這裡需要從POST數據中獲取用戶輸入的Excel數據
    // 例如，假設表單中的input欄位有name屬性分別為"col1"、"col2"、"col3"等等
    $col1 = $_POST['col1'];
    $col2 = $_POST['col2'];
    // ...
    
    // 建立資料庫連接
   

    // 檢查連接是否成功
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    // 將數據插入到MySQL資料庫表中
    $sql = "INSERT INTO balance sheet('Asset Account Subtotal', 'Total asset account') VALUES ('$col1', '$col2')";
 
   

    // 關閉資料庫連接
    $conn->close();
}
?>