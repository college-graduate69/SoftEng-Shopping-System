<?php 
 require_once('autoload.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Shopping ::</title>
    <link rel="stylesheet" type="text/css" media="screen" href="css/products.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="logocontainer">
    <img src="images/logoredesign.png" class="navlogo">
</div>
<div class="navbar">
    <ul>       
        <li> <a href="index.php" class="indexlink"> HOME</a> </li>
        <li> <a href="products.php" class="indexlink"> PRODUCTS</a> </li>
        <li> <a href="about.php" class="indexlink"> ABOUT</a></li>
        <li  class="indexlink"> CART </li>
        <?php if(isset($_SESSION['signeduser'])):?>
            <ul class="navbar-nav ml-auto">
                <a class="indexlink" href="index.php?logout=1">LOGOUT</a>
            </ul>
            <?php endif; ?>
            <?php if(!isset($_SESSION['signeduser'])):?>
            <ul class="navbar-nav ml-auto">
                <span><a href="login.php" class="indexlink">LOGIN</a></span>
            </ul>
        <?php endif;?>
    </ul>
</div>
<!-- nav ends here -->
<div class="proddisplay">
    <div class="displayimg">
        <img src="images/product_images/sporty-shirt.jpg">
    </div>
    <div class="displayinfo">
        <p class="displayname">
            Wool Beret
        </p>
        <p class="displaycategory">
            Accessories
        </p>
        <p class="displayprice">
        &#8369 0.00
        </p>
        <p class="stockinfo">
            Available Quantity: 0
        </p>
        <div class="description">
            Description
        </div>
        <div class="addcart">
            <button type="button" class="addcart">ADD TO CART</button>
        </div>
    </div>
</div>

</body>
</html>