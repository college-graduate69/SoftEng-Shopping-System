<?php 
require_once('autoload.php');
CheckUser();
$items = new Display($db);
$items2 = new Display($db);
$items3 = new Display($db);
$items4 = new Display($db);
$products = new Products($db);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Shopping ::</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
    <script src="java/bootstrap/jquery.min.js"></script>
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
                <li> <a href="cart.php" class="indexlink"> CART </a><span   id="cartCount"><?=count($_SESSION['cart'])?></span></li>
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

<div class="productfilters"> <!-- filter products -->
<div class="filters">
<form action="products.php" method="POST" id="myForm">
<input type="submit" value="All" id="all" class="filterchoices">
<?php foreach($items->displayCategory() as $items): ?>
    <input type="submit" value="<?=$items['productCategory']?>" name="category" id="choice" class="filterchoices">
<?php endforeach;?>

</form>
</div>

</div>

<!-- display products -->
<?php if(isset($_POST['category'])){ //if one of the button is pressed?>
    <div class="prodbody">
    <p class="allprodhead"> <?= $_POST['category']?></p>
    <?php foreach($items2->FilteredProduct($_POST['category']) as $products): //loops the array?>
    <div class="prodcontainer">
        <div class="prodimg">
            <img src="images/product_images/<?=$products['productImage']?>" alt="product Image"/>
        </div>
        <div class="prodname">
            <?= $products['productName']?>
        </div>
        <div class="prodprice">
        &#36;<?= $products['productPrice']?>
        </div>
        <div class="viewbtn">
        <a href="Item.php?type=<?=$products['productType']?>&id=<?=$products['productID']?>"> View Product </a>
        </div>
    </div>
      
<?php endforeach;
        } else { //display all products ?>
        <div class="prodbody">
        <p class="allprodhead"> all products </p>
        
        
        <?php foreach($items3->displayProducts() as $items):?>
        <div class="prodcontainer">
        <div class="prodimg">
            <img src="images/product_images/<?=$items['productImage']?>" alt="product Image"/>
        </div>
        <div class="prodname">
            <?= $items['productName']?>
        </div>
        <div class="prodprice">
        &#36;<?= $items['productPrice']?>
        </div>
        <div class="viewbtn">
             <a href="Item.php?type=<?=$items['productType']?>&id=<?=$items['productID']?>"> VIEW</a>
        </div>
    </div>
    <?php endforeach;?>
<?php }?>
</div>
<!-- footer here -->
    <div class="footer">
        <div class="footercontent">
            <div class="ft1">
                <h4>FOLLOW US</h4>
                <div class="fblink">
                <img src="images/fbicon.png">
                <a href="index.php">my trendy collection</a>
                </div>
                <?php if(isset($_SESSION['signeduser'])):?>
                <div class="footlogreg">
                    <a href="index.php?logout=1"><div class="footlog">
                        LOGOUT
                    </div></a>
                </div>
            <?php endif; ?>
            <?php if(!isset($_SESSION['signeduser'])):?>
            <div class="footlogreg">
                    <a href="login.php"><div class="footlog">
                        LOGIN
                    </div></a>
                    <a href="register.php"><div class="footreg">
                        REGISTER
                    </div></a>
                </div>
        <?php endif;?>
            </div>
            <div class="ft3">
            <div class="navlistfoot">
                    <ul>
                        <a href="index.php"><li>HOME</li></a>
                        <a href="products.php"><li>PRODUCTS</li></a>
                        <a href="about.php"><li>ABOUT</li></a>
                    </ul>
                </div>
            </div>
            <div class="ft2">
            <h4 class="fthelphead">Need Help?</h4>
                <a href="about.css" class="cntctlink">Contact Us</a>
            </div>
        </div>   
    </div>
</body>
</html>
