<?php
$GLOBALS["n"] = 2;
?>
<script>
    var landlord_n = 1;
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="datetest.php">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <?php include 'js/module_basic.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web3/1.6.0/web3.min.js"></script>
    <script type="text/javascript" src="js/contract_abi.js"></script>
    <script type="text/javascript" src="js/loadcontract.js"></script>
    <script>
        function to_contract(){
            var i = document.getElementById('rng').value
            window.location = 'contract.php?rng=' + i;
        }
    </script>
</head>

<body>
<section class="container">

<p></p>
<?php
        $username = $GLOBALS["username"];
        echo "<h1>用戶".$username."</h1>";
        ?>
         <p></p>
          <hr>
          </section>
          <p>日期：<input type="text" id="datepicker" size="30" autocomplete="off" ></p>
<p>隱藏日期：<input type="text" id="altDate" size="30" disabled></p>
    <section class="container">
    <form action="tenant.php" method="get">
        <p></p>
        <div class="col-md-2">
        <input name="date" placeholder="輸入日期" value="<?php if(isset($_GET['date'])){echo $_GET['date'];} ?>">
                <input id="submit" class="btn btn-outline-secondary" type="submit" name="submit" value="搜尋">          
        </div> 
    </form>
<?php
$N = '';
        if(isset($_GET['date']) && $_GET['date'] != $N){
                        $date = "like '".$_GET['date']."%'";
                    }else{
                        $date = "IS NOT NULL";
                    }
                    echo '<script>console.log("township:'.$date.'");</script>';
?>
   
       
      <h1>紀錄</h1>
        <?php
        $conn=require_once "config.php";
        ?>
   
    <script>
        
        
        //偵測按下enter
        function p(i){
            try {
                document.getElementById('checkbox'+i).checked = false;
            } catch (error) {
                
            }
            document.getElementById('submit').click();
        }
    </script>
    <section class="container">
        <?php
        if(isset($_GET['no_matamask']) != true){
            echo '
            
                <table class="table table-bordered">
                <tr>
                    <th scope="col-md-3">日期</th>
                    <th scope="col-md-2">傳票編號</th>
                    <th scope="col-md-2">科目代號</th>
                    <th scope="col-md-2">科目名稱</th>
                    <th scope="col-md-3">摘要</th>
                    <th scope="col-md-3">借方金額</th>
                    <th scope="col-md-3">貸方金額</th>
                    <th scope="col-md-3">餘額</th>
                </tr>';
            //$sql = "SELECT ID FROM contract WHERE tenant_ID ='".$GLOBALS["username"]."'";
           // $sql = "SELECT * FROM `general-ledger`";
           $sql = "SELECT * FROM `general-ledger` WHERE date ".$date."";
            $result = mysqli_query($conn,$sql);
            $loop = 1;
            //$num = mysqli_num_rows($result);
            //echo '<script>alert("有'.$num.'筆資料");</script>';
            while ($row = $result->fetch_assoc()) {
                echo '
                    <tr>
                        <td>
                            <div class="row">
                            <div id="date'.$loop.'">'.$row['date'].'</div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                            <div id="housename'.$loop.'">'.$row['number'].'</div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                            <div id="rent_per_month'.$loop.'">'.$row['codename'].'</div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                            <div id="securityDeposit'.$loop.'">'.$row['Subject-name'].'</div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                            <div id="tenantVerify'.$loop.'">'.$row['Summary'].'</div>
                            </div>
                        </td>
                        <td>
                        <div class="row">
                        <div id="tenantVerify'.$loop.'">'.$row['Debit-amount'].'</div>
                        </div>
                    </td>
                    <td>
                    <div class="row">
                    <div id="tenantVerify'.$loop.'">'.$row['credit-amount'].'</div>
                    </div>
                </td>  <td>
                <div class="row">
                <div id="tenantVerify'.$loop.'">'.$row['balance'].'</div>
                </div>
            </td>
                    </tr>
                    ';
                $loop++;
            }
            echo '</table>';
        }
        ?>
    </section>
    <script>
        function resolveAfter2Seconds(x) {
            return new Promise(resolve => {
                setTimeout(() => {resolve(x);}, 2000);
            });
        }
    </script>
    <footer id="Mfooter">
    </footer>
</body>

</html>