<?php
require_once('autoload.php');
$items = new Display($db);
$products = new Products($db);
AdminCheck();
if(isset($_GET['DeleteId'])) {
    $id = $_GET['DeleteId'];
    $products->deleteItem($id,'admin-inventory.php');
}
if(isset($_POST['updatebtn'])) {
    $products->updateProduct($_POST['productqty'], $_POST['productprice'], $_POST['productId']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>:: Shoppping ::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>
    <body>
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
        <!-- navbar ends here -->
        <div class="tableDiv ">
            <table class="thisTable">
                <thead>
                    <tr class="tableheader">
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Product Qty</th>
                        <th>Product Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tablecontent">
                        <?php foreach($items->displayProducts() as $items): ?>
                        <td class="thisImageHolder"><img class="thisImage" src="images/product_images/<?= $items['productImage']?>" alt="Product Image"></td>
                        <td><?= $items['productName']?></td>
                        <td><?= $items['productType']?></td>
                        <td><?= $items['productQuantity']?> </td>
                        <td><?= $items['productPrice']?></td>
                        <td><button class="btn-delete"  data-toggle="modal" data-target="#remove<?=$items['productID']?>">Remove</button>
                            <button class="btn-edit" data-toggle="modal" data-target="#productEdit<?=$items['productID']?>">Edit</button>
                        </td>
                    </tr>
           

        <div id="remove<?=$items['productID']?>" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="editclose">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="removehead">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    </div>
                        
                        
                    <div class="removebody">
                    <a href="admin-inventory.php?DeleteId=<?=$items['productID']?>">
                        <div class="yesremove">
                            Yes
                        </div>
                        </a>
                        <div class="noremove">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>








        <div id="productEdit<?=$items['productID']?>" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="invmodalclose">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="invmodalhead">
                        <h4 class="modal-title"><?=$items['productName']?></h4>
                        
                    </div>
                    <div class="invmodalbody">
                        <form action="admin-inventory.php" method="POST">
                            <div class="invqty">
                            <input type="hidden" value="<?=$items['productID']?>" name="productId">
                            <label>Product Quantity</label>
                            <input type="number" value="<?=$items['productQuantity']?>" name="productqty" min="0" max="100">
                            </div>
                            <div class="invprice">
                            <label>Product Price</label>
                            <input type="number" value="<?=$items['productPrice']?>" name="productprice" >
                            </div>
                            <div class="invsub">
                            <input type="submit" class="update-btn" name="updatebtn" value="SUBMIT">
                            </div>
                        </form> 

                    </div>
                </div>
            </div>
        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html> 