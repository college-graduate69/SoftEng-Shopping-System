<?php 
 require_once('autoload.php');
 CheckUser();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Shopping :: </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/about.css" />
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
<div class="successcontain">
    <div class="checkimg">
        <img src="images/checkimg.png">
    </div>
    <div class="checkdisplay">
        
    </div>
    <div class="thankhead">
        Thank You For Ordering!
    </div>
    <div class="orderwhen">
        <h5>Your order will be delivered on or before DATE</h5>
    </div>
    
</div>
<div class="nocancelnote">
    Note: All orders are final, for any concerns please contact the owner.
</div>
<a href="products.php" class="checkbacklink">
<div class="checkoutback">
        &#xab;continue shopping
</div>
</a>


<!-- footer starts here-->
<div class="footer">
        <div class="footercontent">
            <div class="ft1">
                <h4>FOLLOW US</h4>
                <div class="fblink">
                <img src="images/fbicon.png">
                <a href="index.php">my trendy collection</a>
                </div>
                <div class="footlogreg">
                    <a href="login.php"><div class="footlog">
                        LOGIN
                    </div></a>
                    <a href="login.php"><div class="footreg">
                        REGISTER
                    </div></a>
                </div>
            </div>
            <div class="ft3">
            <div class="navlistfoot">
                    <ul>
                        <a href="index.php"><li>HOME</li></a>
                        <a href="products.php"><li>PRODUCTS</li></a>
                        <a href="about.php"><li>ABOUT</li></a>
                        <li class="indexlink"> HELLO, USER</li>
                        <li>CART</li>
                        <li>LOGOUT</li>
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
