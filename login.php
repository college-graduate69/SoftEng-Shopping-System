<?php 
require_once('autoload.php');

if(isset($_SESSION['signeduser'])){
    if($_SESSION['userlevel'] == "Customer"){
        header("location: index.php");
    } else {
        header("location: admin.php");
    }
}


if(isset($_POST['loginbtn'])){
    if(!isset($_GET['id'])){
        $userlogin = new user($db);
        $userlogin->Login($_POST['username'],$_POST['password']);
    } else {
        $userlogin = new user($db);
        $userlogin->LoginFromProduct($_POST['username'],$_POST['password'],$_GET['id'],$_GET['type']);
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>:: Shopping ::</title>
        <link rel="stylesheet" type="text/css"href="css/login.css" />
    </head>
    <body>
        <form action="login.php" method="POST"> 
            <div class="loginparentdiv">
                <div class="logodiv">
                    <a href="index.php">
                        <a href="register.php" class = "registersubmit"> REGISTER</a>
                        <a href="index.php" class="return"> &larr; Return to Home </a>    
                        </div>
                    <div class="logindiv">
                        <div class="logininputdiv">
                            <input type="textbox" placeholder="username" class="logininput" name="username">
                            <input type="password" placeholder="password" class="logininput" name="password"><br><br>
                            <button type="submit" class = "loginsubmit" name="loginbtn">LOGIN</button><br><br>
                            <a href="forgot-password.php" class="forgotpassword">Forgot Password?</a>           
                            </form>
                    </div>
                </div>
            </div>
            </body>
        </html>