<?php
    require 'vendor/autoload.php';
    require_once('autoload.php');
    AdminCheck();
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>:: Shoppping ::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
        <script src="main.js"></script>
    </head>
    <body>
        <div class="verticalnav">
            <div class="adminlogo">
                <a href = "admin.php" class = "adminlogo">#</a>
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
        <div class="prodheader">
            <div class="headtxt">
                Produce Sales Report
            </div>
        </div>
        <div class="choicecontainer">
            <form action="admin.php" method = "post">
            <div class="salesdateinput">
            <span class="datelabel">Select Date:</span>
            <input type="date" class="dateinput" name="date">
            </div>
            <div class="reportcat">
                <input type="submit" class="forminput weekly" name="weekly" value="Weekly Report">
                <input type="submit" class="forminput monthly" name="monthly" value="Monthly Report">
                <input type="submit" class="forminput yearly" name="weekly" value="Yearly Report">
            </div> 
            </form>
        </div>
        <div class="choicecontainer">
                <a href="reports/" class="reportlink">&#xab; View Reports</a>
        </div>
    </body>
</html>