<?php 
require_once('autoload.php');
CheckUser();
$total = 0;
$cart = $_SESSION['cart'];

if(isset($_GET['id'])) {
    //    var_dump($_SESSION['cart'][$_GET['id']]);
    $key=array_search($_GET['id'],$_SESSION['cart']);

    unset($_SESSION['cart'][$_GET['id']]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);
    $cart = $_SESSION['cart'];

    header("location:cart.php");
    }

if(isset($_POST['submitOrder'])){
       $date = new DateTime();
        $strdate = $date->format('Y-m-d H:i:s');
       $neworder = new Transaction($db,$strdate, $_SESSION['signeduser'], $_POST['billingAdd']);
        $neworder->submitOrder();
        for($i=0;$i<count($cart);$i++) {
            $neworder->SubmitItems($cart[$i]['id'],$cart[$i]['type'],$cart[$i]['qty'],$cart[$i]['price']);
         }
         
        $_SESSION['cart'] = [];
        header("location:checkout.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Shopping :: </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="css/cart.css" />
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
                <li> <a href="cart.php" class="indexlink"> CART </a><span  id="cartCount"><?=count($_SESSION['cart'])?></span></li>
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
<div class="cartheader">
    <div class="carttitle">
        <h1>MY CART </h1>
    </div>
</div>
<div class="cartbody">
<?php for($i=0;$i<count($cart);$i++): ?>
    <div class="cartgrid">
        <div class="cartimg">
            <img src="images/product_images/<?=$cart[$i]['image']?>">
        </div>
        <div class="cartname">
            <p><?= $cart[$i]['name']?></p>
            <p><?= $cart[$i]['type']?><p>
        </div>
        <div class="cartqty">
            <p>Quantity: <?= $cart[$i]['qty']?></p>
        </div>
        <div class="cartprice">
            <p>&#36;<?= $cart[$i]['price']?></p>
        </div>
        <div class="cartremove">
            <a href="cart.php?id=<?= $i?>" class="removecartprod">Remove</a>
        </div>
    </div>
    <?php endfor;?>
</div>
<div class="cartcheckout">
    <?php if(!empty($_SESSION['cart'])): ?>
    <div class="cartcheck">
        <button data-toggle="modal" data-target="#checkoutmodal">CHECK OUT</button>
    </div>
    <?php else: ?>
       <center> <h4> Your Cart is Empty </h4></center><br><br>
    <?php endif; ?>
    
    <div class="cartback">

        <a href="products.php">&#xab;continue shopping</a>
    </div>

</div>

  

<div class="modal fade" id="checkoutmodal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modalclose">
                <button type="button" id = "close" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="cartmodalheader">
            <h4><center>CHECKOUT</center></h4>
            </div>
        <form action="cart.php" method="POST" class="cartmodalform">
        <?php if(isset($_SESSION['signeduser'])):?>
        <input type="hidden" value="<?= $_SESSION['username']?>" name="username">
<?php endif;?>
            <?php for($i=0;$i<count($cart);$i++):
                $total +=$cart[$i]['price'];
            endfor;?>
            <h5>My Orders Total Price: <span class="carttotalprice">&#36;<?= $total+45?></span></h5>

            <table class="table">
                <thead>     
                <th>Product Name </th>
                <th class="modaltxtcart">Quantity </th>
                <th class="modaltxtcart">Price </th>
                </thead>

                <tbody>
                <?php for($i=0;$i<count($cart);$i++): ?>
                        <tr>
                            <td><?=$cart[$i]['name']?></td>

                            <td class="modaltxtcart"><?=$cart[$i]['qty']?></td>
                            <td class="modaltxtcart"><?=$cart[$i]['price']?></td>
                            </tr>
                    <?php endfor;?>
                            <td> Shipping Fee </TD>
                            <td></td>
                            <td class="modaltxtcart">45</td>
                </tbody>
            </table>
            <div class="cartmodalmethod">
                <div class="paymetlabel">
                    <p>Payment Method</p>
                </div>
                <div class="inputpay">
                    <input type="Text" value="Cash on Delivery" disabled>
                </div>
            </div>
            <div class="address">
                <div class="modaddlabel">
                    <p>Billing Address</p>
                </div>
                <div class="addressinput">
                    <input type="Text" name="billingAdd" value="<?php echo $_SESSION['address'];?>">
                </div>
            </div>
            <div class="modal-footer">
             <input type="submit" value="Confirm Checkout" name="submitOrder" class="btn btn-success">
             <button class="btn btn-danger">Cancel Order</button>
            </div>
        </form>
       
        </div>


</div>

</div>

<!--footerhere-->
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
   <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>