<?php
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
    </head>
    <body>
        <div class="verticalnav">
            <div class="adminlogo">
                <a href = "admin.php" class = "adminlogo"></a>
            </div>
            <ul class="navlist">
                <li><a href="admin-products.php" class="adminlinks">Products</a></li>
                <li><a href="admin-transaction.php" class="adminlinks">Orders</a></li>
                <li><a href="admin.php" class="adminlinks">Sales Reports</a></li>
                <?php if(isset($_SESSION['signeduser'])):?>
                <li><a class="adminlinks" href="index.php?logout=1">LOGOUT</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- navbar ends here -->
        <div class="prodheader">
            <div class="headtxt">
                Manage Your Products
            </div>
        </div>
        <div class="choicecontainer">
            <a href="add-products.php">
                <div class="prodchoice1">
                    <div class="choiceimg">
                        <img src="images/addproductlogo.png" class="imgclass">
                    </div>
                    <div class="choicelabel">
                        Add Product
                    </div>
                </div>
            </a>
            <a href="add-category.php">
                <div class="prodchoice2">
                    <div class="choiceimg">
                        <img src="images/categoryproductlogo.png" class="imgclass">
                    </div>
                    <div class="choicelabel">
                        Add Product Category
                    </div>
                </div>
            </a>
            <a href="admin-inventory.php">
                <div class="prodchoice3">
                    <div class="choiceimg">
                        <img src="images/inventorylogo.png" class="imgclass">
                    </div>
                    <div class="choicelabel">
                        View Products
                    </div>
                </div>
            </a>
        </div>
    </body>
</html>