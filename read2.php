<!DOCTYPE html>
<html>

<head>
    <title>讀取Excel資料</title>
</head>

<body>
    <form method="post" action="save_to_mysql.php">
        <!-- 其他表單元素 -->
        <input required class="col-md-10" name="col1" placeholder="" type="number">
        <input required class="col-md-10" name="col2" placeholder="" type="number">
        <input type="submit" value="保存到MySQL">
    </form>
    <input type="file" id="excelFile" accept=".xlsx, .xls" />
    <div id="excelData"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

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

                    table += '<td><input type="text" name="data[i][col]" value="' + data[i][col] + '"></td>';

                }
                table += '</tr>';
            }

            table += '</table>';
            document.getElementById('excelData').innerHTML = table;


        }
    </script>

</body>


</html>