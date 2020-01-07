<?php
    require_once('autoload.php');
    
    if(isset($_POST['loginbtn'])){
        if(!isset($_GET['id'])){
            $user = new user($db);
            $user->Courier($_POST['username'],$_POST['password']);
        } else {
            $user = new user($db);
            $user->CourierFromProduct($_POST['username'],$_POST['password'],$_GET['id'],$_GET['type']);
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/courier.css" />
    <script src="main.js"></script>
</head>
<body>
<div class="loginparentdiv">
<div class="logindiv">
<div class="logocontainer">
    
</div>
                            <form action="courier.php" method="POST"> 
                        <div class="logininputdiv">
                            <input type="textbox" placeholder="username" class="logininput" name="username">
                            <input type="password" placeholder="password" class="logininput" name="password"><br><br>
                            <button type="submit" class = "loginsubmit" name="loginbtn"value>LOGIN</button><br><br>     
                            </form>
                    </div>
                </div>
            </div>

</body>
</html> 