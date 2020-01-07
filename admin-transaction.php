<?php
require_once('autoload.php');

$display = new Display($db);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>:: Shoppping ::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="main.js"></script>
    </head>
    <body class="orderbg">
    <div class="prodheader">
            <h1 class="headtxt">Orders</div>
        </div>
         <div class="verticalnav">
            <div class="adminlogo">
                <a href = "admin.php" class = "adminlogo"></a>
            </div>
            <ul class="navlist">
                <li><a href="admin-products.php" class="adminlinks">Products</a></li>
                <li><a href="admin-transaction.php" class="adminlinks">Orders</a></li>
                <li><a href="admin-sales-report.php" class="adminlinks">Sales Reports</a></li>
                <?php if(isset($_SESSION['signeduser'])):?>
                <li><a class="adminlinks" href="index.php?logout=1">LOGOUT</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- nav ends here-->
        <div class="transdiv">
        <div class="inlinethis">
            <?php foreach($display->displayTransactions() as $list): ?>
            <?php foreach($list['details'] as $details): ?>
                    <div class="col-md-5 mr-3 p-3" id="cartContainer">
                    <?php if($details['status'] == 'cancelled'):?>
                        <div class="alert alert-danger">
                            <center><strong>Transaction cancelled</strong></center>
                        </div>
                    <?php endif;?>
                    <div class="transdivide">
                <table width="100%">
                    <div class="prodinfodiv">
                    <tr>
                        <th>Product Name</th>
                        <th class="centerthis">Product Quantity</th>
                        <th class="centerthis">Price</th>
                    </tr>
                        <?php foreach($details['products'] as $products): ?>
                            <tr>
                                <td><?=$products['productName']?></td>
                                <td class="centerthis"><?=$products['ProductQty']?></td>
                                <td class="centerthis"><?=$products['productPrice']?></td>           
                            </tr>
                            
                        <?php endforeach;?>
                        <tr>
                            <td class="totalprice"><b>Total:</b> P<?=$details['total']?></td>
                        </tr>
                    
                    </div>
                        <b class="orderlabel">Customer: </b> <?=$details['fullName']?><br>
                        <b class="orderlabel">Contact: </b> <?=$details['contact']?><br>
                        <b class="orderlabel">Address: </b><?=$details['address']?><br>
                        <?php if($details['status'] == "complete"):?>
                        <b class="orderlabel">Status: </b><span style="color:#00ca65;"><?=$details['status']?></span><br>
                        <?php else:?>
                        <b class="orderlabel">Status: </b><span class="orderstatus"><?=$details['status']?></span><br>                        
                        <?php endif;?>
                        <?php
                             $today = $details['transactionDate'];
                             $date = date_create($today);
                             date_add($date, date_interval_create_from_date_string("0 days"));
                        ?>
                        <b class="orderlabel">Date of Order:</b> <?=date_format($date, "Y-m-d h:i:sa")?><br>
                        <?php
                             $today = $details['transactionDate'];
                             $date = date_create($today);
                             date_add($date, date_interval_create_from_date_string("5 days"));
                        ?>
                        <b class="orderlabel">Lead Time:</b> <?=date_format($date, "Y-m-d h:i:sa")?>
                        <hr>
                          </table>

                    </div>
                    </div>
                    <?php endforeach;?>
                   
              
            <?php endforeach;?>
            </div>
        </div>
                   <script src="js/admin.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>
    </body>
</html>