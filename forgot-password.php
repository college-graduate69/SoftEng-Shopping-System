<?php
    require_once('autoload.php');
    CheckUser();
    $account = new user ($db);

    function errorDisplay(){
        echo '
        <div class="alert alert-danger mt-3">
            <strong>Submission Error!</strong>
        </div>
        ';
    }
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <meta charset="utf-8" />
        <title>:: Shopping ::</title>
        <link rel="stylesheet" type="text/css"href="css/login.css" />
    </head>
    <body>
    <form action="forgot-password.php" method="post">
    <div class="loginparentdiv">
        <div class="logodiv">
            <a href="index.php">
            <a href="index.php" class="return"> &larr; Return Home </a>
        </div>
        <div class="logindiv">
            <div class="logininputdiv">
                <h1 class="fpheadtxt"> FORGOT PASSWORD </h1>
                    <?php 
                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\Exception;

                        require 'vendor/autoload.php';
                        
					    if(isset($_POST['retrieve'])) {
                        
                            $account->retrievePassword($_POST['email']);
                            $password = $_SESSION['pass'];

                            $email = $_POST['email'];

                            $retrieve = "<b>Your Password is:</b>" .  $password; 

                            $mail = new PHPMailer(true); 
                                try {
                                    //Server settings
                                    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                                    $mail->isSMTP();                                      // Set mailer to use SMTP
                                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                    $mail->Username = 'jewelreventar1@gmail.com';                 // SMTP username
                                    $mail->Password = '09060829431';                           // SMTP password
                                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                    $mail->Port = 587;                                    // TCP port to connect to

                                    $mail->setFrom('jewelreventar1@gmail.com', 'My Trendy Collection');
                                    $mail->addAddress($email);     // Add a recipient  

                                    //Content
                                    $mail->isHTML(true);                                  // Set email format to HTML
                                    $mail->Subject = 'My Trendy Collection Account Credentials';
                                    $mail->Body    = $retrieve;
                                    $mail->send();
                                    //Add User to Database
                                
                                
                                } catch (Exception $e) {
                                    errorDisplay();
                                }
                        }
						
                    ?>
                <input type="textbox" placeholder="Email Address" class="logininput" name="email">
                <button type="submit" class="loginsubmit" name="retrieve"> SEND </button>
            </div>
        </div>
    </div>
    </form>
    </body>
</hmtl>