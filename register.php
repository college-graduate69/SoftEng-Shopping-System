<?php 
require_once('autoload.php');

if(isset($_SESSION['signeduser'])){
    if($_SESSION['userlevel'] == "Customer"){
        header("location: index.php");
    } else {
        header("location: admin.php");
    }
}

if(isset($_POST['registerbtn'])){
    $user = new user($db);
    $user->Register($_POST['usertype'],$_POST['fullname'],$_POST['address'],$_POST['email'],$_POST['username'],$_POST['password']);
}


function registerSuccess(){
    echo '
              <div class="alert alert-success">
                  <strong>Success!</strong> Registration complete! You may Log in Now.
                  <a href="login.php"> Login Now </a>
              </div>';
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>:: Shopping ::</title>
        <link rel="stylesheet" type="text/css" href="css/register.css" />
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
            <?php
            if(isset($_SESSION['registration'])){
                registerSuccess();
                unset($_SESSION['registration']);
            }
            ?>
            
    <div class="regformdiv">
    <h1 class="regheadtxt">SIGN UP</h1>
        <div class="formdiv">
            <form action="register.php" method="POST" class="regform">
            <input type="hidden" name="usertype" value="Customer">
            <input type="text" placeholder="FULL NAME" name="fullname" class="regname">
            <input type="text" placeholder="ADDRESS" name="address" class="regadd">   
            <input type="text" placeholder="E-MAIL" name="email" class="regemail">  
            <input type="text" placeholder="USERNAME" name="username" class="reguser">  
            <input type="password" placeholder="PASSWORD" name="password" class="regpass">  
            <br>
            <input type="submit"  name="registerbtn" class="regbutton">
            </form>
        </div>
    </div>

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


