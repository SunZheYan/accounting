<script>
        
        // 當文件選擇器變化時處理Excel文件
        document.getElementById('excelFile').addEventListener('change', handleFile, false);

        function handleFile(e) {
            var file = e.target.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                var data = event.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });
                var sheetName = workbook.SheetNames[0];
                var sheet = workbook.Sheets[sheetName];
                var jsonData = XLSX.utils.sheet_to_json(sheet);

                displayData(jsonData);
            };

            reader.readAsBinaryString(file);
        }

        function displayData(data) {
            var table = '<table border="1">';
            table += '<tr>';
            for (var col in data[0]) {
                table += '<th>' + col + '</th>';
            }
            table += '</tr>';

            for (var i = 0; i < data.length; i++) {
                table += '<tr>';
                for (var col in data[i]) {
                    //判斷日期是否為空並補齊
                    if (col === '日期') {
                        if (data[i][col] === '') {
                            var dateValue = '';
                var rowIndex = i - 1;
                while (dateValue === '' && rowIndex >= 0) {
                    dateValue = data[rowIndex][col];
                    rowIndex--;
                }
                table += '<td><input type="text"  value="' + dateValue + '"></td>';
                        }else{
                            table += '<td><input type="text" value="' + data[i][col] + '"></td>';}
                        
                    } 

                    
                    else {
                        table += '<td><input type="text"  value="' + data[i][col] + '"></td>';
                    }
                }
                table += '</tr>';
            }

            table += '</table>';
            document.getElementById('excelData').innerHTML = table;
       
        
        
        // 將 JSON 資料轉換成字串
        var jsonDataString = JSON.stringify(data);
        
        // 將 JSON 字串放入隱藏欄位中
        document.getElementById('jsonDataInput').value = jsonDataString;}
      
        
        document.getElementById('saveToMySQL').addEventListener('click', function() {
        
            // 從excelData div中獲取JSON數據（假設它已經被填充）
            var jsonData = document.getElementById('jsonDataInput').value;

// 使用AJAX將JSON數據發送到服務器
$.ajax({
    type: 'POST',
    url: 'testupda.php',
    data: { jsonData: jsonData },
    success: function(response) {
        alert(response); // 顯示來自服務器的回應信息
    },
    error: function() {
        alert('數據提交時出現錯誤。');
    }
});
});
    
    </script> 