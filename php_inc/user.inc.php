<?php 
    class user {
        private $db;
        
        public function __construct($db){
            $this->db = $db;
        }

        public function Register($usertype, $fullname, $address, $email, $username, $password) {
            $stmt = $this->db->prepare("INSERT INTO users (user_type, full_name, user_address, email, username, user_password) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $usertype, $fullname, $address , $email, $username, $password);
            $stmt->execute();
            $stmt->close();
            $_SESSION['registration'] = 1;
        }

        public function Courier($username,$password) {
            $stmt = $this->db->prepare("SELECT id,user_type,user_password,user_address FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $stmt->bind_result($id,$userlevel,$_password, $address);
            $stmt->fetch();
            if($_password != $password){
                echo "<h1>";
                echo "error";
                echo "</h1>";
            }else{
                if($userlevel == "Admin"){
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['userlevel'] = $userlevel;
                    header("location: courier-page.php");
                } else { 
                    echo "Error";
                }
                
            }
            $stmt->close();
        }

        public function CourierFromProduct($username,$password,$productID,$type) {
            $stmt = $this->db->prepare("SELECT id,user_type,user_password FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $stmt->bind_result($id,$userlevel,$_password);
            $stmt->fetch();
            if($_password != $password){
                echo "error";
            }else{
                if($userlevel == "Admin"){
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['userlevel'] = $userlevel;
                    header("location: courier-page.php");
                } else {
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['username'] = $username;
                    $_SESSION['userlevel'] = $userlevel;
                    header("location: Item.php?type=$type&id=$productID");
                }
                
            }
            $stmt->close();
        }
        
        public function Login($username,$password) {
            $stmt = $this->db->prepare("SELECT id,user_type,user_password,user_address FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $stmt->bind_result($id,$userlevel,$_password, $address);
            $stmt->fetch();
            if($_password != $password){
                echo "<h1>";
                echo "error";
                echo "</h1>";
            }else{
                if($userlevel == "Admin"){
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['userlevel'] = $userlevel;
                    header("location: admin.php");
                } elseif($userlevel == "Customer") {
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['username'] = $username;
                    $_SESSION['userlevel'] = $userlevel;
                    $_SESSION['address'] = $address;
                    header("location: index.php");
                } else { 
                    echo "fill in the blank textboxes";
                }
                
            }
            $stmt->close();
        }

        public function LoginFromProduct($username,$password,$productID,$type) {
            $stmt = $this->db->prepare("SELECT id,user_type,user_password FROM users WHERE username = ? LIMIT 1");
            $stmt->bind_param('s',$username);
            $stmt->execute();
            $stmt->bind_result($id,$userlevel,$_password);
            $stmt->fetch();
            if($_password != $password){
                echo "error";
            }else{
                if($userlevel == "Administrator"){
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['userlevel'] = $userlevel;
                    header("location: admin.php");
                } else {
                    $_SESSION['signeduser'] = $id ;
                    $_SESSION['username'] = $username;
                    $_SESSION['userlevel'] = $userlevel;
                    header("location: Item.php?type=$type&id=$productID");
                }
                
            }
            $stmt->close();
        }


        public function Logout($session){
            session_destroy();
            unset($session);
            header('location: index.php');
        }

        //public function CheckSess(){
         //   if(($_SESSION['userlevel'] != "Admin")){
        //        header("location: index.php");
        //    }
       // }

        public function retrievePassword($email){
            $stmt = $this->db->prepare("SELECT email, user_password FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($_email, $password);
            $stmt->fetch();
            $stmt->fetch();
            if ($email != $_email) {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>Not a valid Email Address.</strong>
                </div>
                ";
            } else {
                $_SESSION['pass'] = $password;
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>Password Retrieved!</strong>&nbsp;Please view your email address.
                </div>
                ";
            }
            $stmt->close();
            }
    }
?>