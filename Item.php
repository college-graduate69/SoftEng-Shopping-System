<?php
require_once('autoload.php');
CheckUser();
$products = new Display($db);
$check = new Products($db);

if(isset($_POST['ItemQty'])){
    if($check->ItemCheck($_GET['id'], $_POST['ItemQty']) == true) {
        if(isset($_SESSION['cart'])) {
            array_push($_SESSION['cart'],['qty'=>$_POST['ItemQty'],'price'=>$_POST['productPrice']*$_POST['ItemQty'], 'id'=>$_GET['id'], 'name'=>$_POST['productName'],'type'=>$_POST['productType'], 'image'=>$_POST['productImage']]);
        }
    } else {
        $_POST['error'] = 1;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>:: Shopping :: </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
        <script src="main.js"></script>
    </head>
    <body>
        <div class="logocontainer">
            <h1>ONLINE BEAUTY SUPPLIES</h1>
        </div>
        <div class="navbar">
            <ul>       
                <li> <a href="index.php" class="indexlink"> HOME</a> </li>
                <li> <a href="products.php" class="indexlink"> PRODUCTS</a> </li>
                <li> <a href="about.php" class="indexlink"> ABOUT</a></li>
                <?php if(isset($_SESSION['signeduser'])): ?>
                <li> <a href="cart.php" class="indexlink"> CART </a><span id="cartCount"><?=count($_SESSION['cart'])?></span></li>
                <li> HELLO, <?= strtoupper($_SESSION['username']);?>
                    <?php endif;?>
                    <?php if(isset($_SESSION['signeduser'])):?>
                    <li>
                        <a class="indexlink" href="index.php?logout=1">LOGOUT</a>
                    </li>
                    <?php endif; ?>
                    <?php if(!isset($_SESSION['signeduser'])):?>
                    <li>
                        <span><a href="login.php" class="indexlink">LOGIN</a></span>
                    </li>
                    <?php endif;?>
            </ul>
        </div>
        <!-- nav ends here -->

        <?php if(isset($_GET['id'])){?>
        <div class="proddisplay">
            <?php foreach($products->ProductItem($_GET['id']) as $item): ?>
            <form action="Item.php?type=<?php $_GET['type']?>&id=<?=$_GET['id']?>" method="POST">
                <div class="displayimg">
                    <img class="" src="images/product_images/<?=$item['ProductImg']?>" alt="<?=$item['productName']?>"/>
                </div>
                <?php if(isset($_POST['error'])):?>
                <div class="alert alert-danger" role="alert">
                    Not Enough Stocks
                </div>
                <?php endif;?>
                <input type="hidden" name="productImage" value="<?= $item['ProductImg']?>">
                <input type="hidden" name="productPrice" value="<?=$item['productPrice']?>">
                <input type="hidden" name="productName" value="<?=$item['productName']?>">
                <input type="hidden" name="productType" value="<?=$item['productType']?>">

                <div class="displayinfo">
                    <p class="displayname">
                        <?=$item['productName']?>
                    </p>
                    <p class="displaycategory">
                        <?= $item['productType'] ?>
                    </p>
                    <p class="displayprice">
                    &#36; <?= $item['productPrice']?>
                    </p>
                    <p class="stockinfo">
                    <?php if($_GET['type'] == "Clothes"):?>
                    Available Quantity:<br>
                    Small: <?=$item['QuantityS']?><br>
                    Medium: <?=$item['QuantityM']?><br>
                    Large: <?=$item['QuantityL']?>
                    <?php else:?>
                    Available Quantity: <?= $item['productQuantity']?>
                    <?php endif;?>
                    </p>
                    <div class="description">
                        <?= $item['productInfo'] ?>
                    </div>

                    <?php if(!isset($_SESSION['signeduser'])){ ?>
                    <h4 id="itemAlert" class="itemalert">You must be logged in to use the Cart.</h4>
                    <div class="userlogin">
                        <a class="btn btn-success mr-4" href="login.php?type=<?= $item['productType']?>&id=<?= $_GET['id']?>">
                            <div class="loginbtn">LOGIN
                            </div>
                        </a>
                        <a class="btn btn-success" href="register.php" class="regbtn">
                            <div class="regbtn">REGISTER
                            </div>
                        </a></li>
                </div>
                </div>  
            <?php } else {?>
                <?php if($_GET['type'] == "Clothes"):?>
                <select name="Size" class="SizeOption">
                <option value="<?= $item['QuantityS']?>">S</option>
                <option value="<?= $item['QuantityM']?>">M</option>
                <option value="<?= $item['QuantityL']?>">L</option>
                </select>
            <?php endif;?>
            <div class="qtytag">
                <h4>Enter Quantity:</h4>
            </div>

            <?php if($_GET['type'] == "Clothes"):?>
            <div class="qtyboxdiv">
                <h5><input placeholder="Enter Quantity" type="number" name="ItemQtySize" id="" min="1" required class="qtybox"></h5>
            </div>
            <?php else:?>
            <div class="qtyboxdiv">
                <h5><input placeholder="Enter Quantity" type="number" name="ItemQty" id="" min="1" required class="qtybox"></h5>
            </div>
            <?php endif;?>
            <div class="addcart">
                <input type="submit" class="addcart" value="Add to Cart">
                <?php } ?>
            </div>
        </div>
        </form>
    <a href="products.php" class="returnbtn">&#xab; back to products <a>
        <?php endforeach;?>
        <?php }?>
        </div>
        

        </body>
</html>