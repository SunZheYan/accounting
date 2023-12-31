<!DOCTYPE html>
<html>

<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="study_project-main/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <?php include 'js/module_basic.php'; ?>
<head>
    <title>讀取Excel資料</title>
</head>

<body>
    <form method="post" action="save_to_mysql.php">
        <!-- 其他表單元素 -->
        <input required class="col-md-10" name="col1" >
        <input required class="col-md-10" name="col2" >
        <input required class="col-md-10" name="col3" >
        <input required class="col-md-10" name="col4" >
        <input required class="col-md-10" name="col5" >
        <input required class="col-md-10" name="col6" >
        <input required class="col-md-10" name="col7" >
        <input required class="col-md-10" name="col8" >
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

                    table += '<td>' + data[i][col] + '</td>';

                }
                table += '</tr>';
            }

            table += '</table>';
            document.getElementById('excelData').innerHTML = table;


        }
    </script>

</body>


</html>