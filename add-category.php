<?php
require_once('autoload.php');
AdminCheck();
$productCategories = new Display($db);
$categoryRemove = new Products($db);
if(isset($_POST['AddCategorybtn'])){
    $category = new products($db);
    $category->addCategory($_POST['categories']);
}
if(isset($_GET['DeleteId'])) {
    $id = $_GET['DeleteId'];
    $categoryRemove->deleteCategory($id,'add-category.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>:: Shoppping ::</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            <h1 class="headtxt">Add Product Category</h1>
        </div>
        <div class="categoryform">
            <div class="cat-input">
            <form action="add-category.php"method ="post">
            <div class="cattxtbox">
                <input type="text" name="categories" placeholder="Category Name" class="catin">
            </div>
            <div class="catbtn">
                <input type="submit" name="AddCategorybtn" placeholder="Add Category" class="catsub" value="+"/>
            </div>
            </form>
            </div>
            <?php foreach($productCategories->displayCategory() as $categories): ?>
            <div class="catlistcontainer">
                <div class="catlist">                  
                    <p class="catnames"> <?= $categories["productCategory"] ?> </p>
                </div>
                <div class="catactions">
                <button class="catremove"  data-toggle="modal" data-target="#remove<?=$categories['id']?>">Remove</button>
                <button class="catedit"  data-toggle="modal" data-target="#CategoryEdit<?=$categories['id']?>">Edit</button>   
                </div>             
            
            </div>
            <div id="remove<?=$categories['id']?>" class="modal fade" role="dialog">
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
                    <a href="add-category.php?DeleteId=<?=$categories['id']?>">
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

        <div id="CategoryEdit<?=$categories['id']?>" class="modal fade" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="editclose">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modedithead">
                        <h4 class="modal-title">Edit <?=$categories['productCategory']?></h4>
                    </div>
                    <div class="modal-body">
                        <form action="add-category.php" method="POST">
                            <div class="editinput">
                                <input type="hidden" value="<?=$categories['id']?>" name="productId">
                                <input type="text" value="<?=$categories['productCategory']?>" name="Catname" class="edittxtbox">
                            </div>
                            <div class="editmodalbtn">
                                <input type="submit" class="update-btn" name="updatebtn" class="cateditbtnm">
                            </div>
                        </form> 

                    </div>
                </div>
            </div>
        </div>
            <?php endforeach; ?>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>    