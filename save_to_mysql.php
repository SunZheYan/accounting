<?php
$conn=require_once "config.php";

// 獲取提交的數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 這裡需要從POST數據中獲取用戶輸入的Excel數據
    // 例如，假設表單中的input欄位有name屬性分別為"col1"、"col2"、"col3"等等
    $col1 = $_POST["col1"];
    $col2 = $_POST["col2"];
    $col3 = $_POST["col3"];
    $col4 = $_POST["col4"];
    $col5 = $_POST["col5"];
    $col6 = $_POST["col6"];
    $col7 = $_POST["col7"];
    $col8 = $_POST["col8"];
    // ...
    $sql = "INSERT INTO  `general-ledger` (`date`,`number`,
    `codename`,`Subject-name`,`Summary`,`Debit-amount`,`credit-amount`,`balance`) VALUE ('".$col1."', '".$col2."', '".$col3."', '".$col4."', '".$col5."', '".$col6."', '".$col7."', '".$col8."')";

    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    $result = mysqli_query($link,$sql);
    
    // 如果有異動到資料庫數量(更新資料庫)
    if (mysqli_affected_rows($link)>0) {
    // 如果有一筆以上代表有更新
    // mysqli_insert_id可以抓到第一筆的id
    $new_id= mysqli_insert_id ($link);
    echo "新增後的id為 {$new_id} ";
    }
    elseif(mysqli_affected_rows($link)==0) {
        echo "無資料新增";
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
     mysqli_close($link); 

    // 關閉資料庫連接
}

