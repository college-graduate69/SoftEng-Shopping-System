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
<div class="faqcontainer">
    <div class="faqheader">
        <p>FAQ</p>
    </div>
    <!--faq q&a-->
    <div class="question">
        + What are your payment options?
    </div>
    <div class="answer">
        Currently, our only available payment option is Cash-On-Delivery.
    </div>
    <!--end-->
    <div class="question">
        + How much is the shipping fee?
    </div>
    <div class="answer">
        For Orders the shipping fee is &#36;5.00.
    </div>
    <!--end-->
    <!--end-->
    <div class="question">
        + Regarding returns and refunds
    </div>
    <div class="answer">
        For any concerns regarding returns and refunds, kindly contact the shop owner through call or text. The shop owner's contact numbers are listed below:<br><span class="faqnums">0916 2924 899 <br>0939 8074 787</span>
    </div>
    <!--end-->
    
</div>

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