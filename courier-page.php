<?php
    require_once('autoload.php');
    
if(isset($_SESSION['signeduser'])){
    if($_SESSION['userlevel'] != "Admin"){
        header("location: Courier.php");
    } else {
    }
}
    $display = new Display($db);
    $receipt = new Receipt($db);

    if(isset($_GET['completeid'])) {
        $id = $_GET['completeid'];
        $receipt->completeTransaction($id);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Shopping :: </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/courier.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="loginparentdiv">
<div class="logindiv">
<div class="logocontainer">
    <!-- <img src="images/logoredesign.png" class="navlogo"> -->
</div>
<table width="100%">
            
<?php foreach($display->displayTransactions() as $list): ?>
            <?php foreach($list['details'] as $details): ?>
                    <div class="col-md-5 mr-3 p-3" id="cartContainer">
                    <?php if($details['status'] == 'cancelled'):?>
                        <div class="alert alert-danger">
                            <center><strong>Transaction cancelled</strong></center>
                        </div>
                    <?php endif;?>
                <table width="100%">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                    </tr>
                        <?php foreach($details['products'] as $products): ?>
                            <tr>
                                <td><?=$products['productName']?></td>
                                <td><?=$products['ProductQty']?></td>
                                <td>P<?=$products['productPrice']?></td>           
                            </tr>
                            
                        <?php endforeach;?>
                        <tr>
                            <td><b>Total:</b> P<?=$details['total']?></td>
                        </tr>
                        <b>Customer:</b> <?=$details['fullName']?><br>
                        <b>Address:</b><?=$details['address']?><br>
                        <?php
                             $today = $details['transactionDate'];
                             $date = date_create($today);
                             date_add($date, date_interval_create_from_date_string("0 days"));
                        ?>
                        <b>Date of Order:</b> <?=date_format($date, "Y-m-d h:i:sa")?><br>
                        <?php
                             $today = $details['transactionDate'];
                             $date = date_create($today);
                             date_add($date, date_interval_create_from_date_string("5 days"));
                        ?>
                        <b>Lead Time:</b> <?=date_format($date, "Y-m-d h:i:sa")?>
                        <hr>
                          </table>

                    </div>
                    <center><a href="courier-page.php?completeid=<?=$details['transactionId']?>" class="updatebtn">Complete</a></center>
                    <?php endforeach;?>

            <?php endforeach;?>
          
                    </div>
                </div>
            </div>

</body>
</html> 