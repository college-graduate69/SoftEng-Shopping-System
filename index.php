<?php 
require_once('autoload.php');
CheckUser();
if(!isset($_SESSION['cart'])) {
    $_SESSION['cart']=[];
};
if(isset($_GET['logout'])){
    $userlogout = new user($db);
    $userlogout->Logout($_SESSION);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>:: Shopping :: </title>
    <link rel="stylesheet" type="text/css"  href="css/index.css" />
</head>
<body>
<!--navbar-->
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
<!--navbar ends here-->
    <div>
        <div class="slidecontainer">
            <img src="images/slidex4.png" class="slideimgs">
            <img src="images/slidex5.png" class="slideimgs">
            <img src="images/slidex6.png" class="slideimgs">
            <button class="btnleft" id="btnL" onclick="plusIndex(-1)">&#10094;</button>
            <button class="btnright" id="btnR" onclick="plusIndex(1)">&#10095;</button>
        </div>
    </div>
    <div class="portion1">
        <a href="register.php">
            <div class="circle1">
                <p>REGISTER</p>
            </div>
        </a>
        <a href="products.php">
            <div class="circle2">
                <p>SHOP</p>
            </div>
        </a>
        <a href="about.php">
            <div class="circle3">
                <p>FAQ</p>
            </div>
        </a>
    </div>
    <div class="portion2">
        <div class="c1desc">
            Register now to order any product on the website.
        </div>
        <div class="c2desc">
            Browse through our available products and place your order.
        </div>
        <div class="c3desc">
            For any concerns please check our F.A.Q. page.
        </div>
    </div>
    <!--
    <div class="newcontainer">
        <div class="newheader">
            NEWEST PRODUCTS
        </div>
        <div class="newprod">
            <div class="newpimg">
                <img src="images/product_images/sporty-shirt.jpg">
            </div>
            <div class="newpname">
                Sporty Shirt
            </div>
            <div class="newpprice">
                &#8369;0.00
            </div>
            <div class="newpprice">
                asdasmdasd
            </div>
        </div>
    </div>-->
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
<script src="java/index.js"></script>
</html>
