<?php

$conn=require_once "config.php";

// 獲取提交的數據
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 讀取隱藏欄位中的 JSON 資料
    $jsonData = $_POST["jsonData"];
    // 將 JSON 資料轉換回 PHP 陣列
    $data = json_decode($jsonData, true);
        foreach ($data as $row) {
            $date = $row["日期"];
            $number = $row["傳票編號"];
            $codename = $row["科目代號"];
            $subjectName = $row["科目名稱"];
            $summary = $row["摘要"];
            $debitAmount = $row["借方金額"];
            $creditAmount = $row["貸方金額"];
            $balance = $row["餘額"];


                // 如果日期為空，從上方找到最近的非空日期填入
    if (empty($date)) {
        $dateValue = '';
        $rowIndex = array_search($row, $data) - 1; // 找到當前行在 data 中的索引，並向上移一行
        while ($dateValue === '' && $rowIndex >= 0) {
            $dateValue = $data[$rowIndex]["日期"];
            $rowIndex--;
        }
        $date = $dateValue;
    }
    // ...
    $sql = "INSERT INTO `general-ledger` (`date`, `number`, `codename`, `Subject-name`, `Summary`, `Debit-amount`, `credit-amount`, `balance`) 
    VALUES ('$date', '$number', '$codename', '$subjectName', '$summary', '$debitAmount', '$creditAmount', '$balance')";

    // 用mysqli_query方法執行(sql語法)將結果存在變數中
    $result = mysqli_query($link,$sql);
    
 
    

    // 關閉資料庫連接
} 
   // 如果有異動到資料庫數量(更新資料庫)
   if (mysqli_affected_rows($link)>0) {
    // 如果有一筆以上代表有更新
    // mysqli_insert_id可以抓到第一筆的id
    //$new_id= mysqli_insert_id ($link);
   // echo "新增後的id為 {$new_id} ";
   echo "成功 ";
    }
    elseif(mysqli_affected_rows($link)==0) {
        echo "無資料新增";
    }
    else {
        echo "{$sql} 語法執行失敗，錯誤訊息: " . mysqli_error($link);
    }
mysqli_close($link); 
}