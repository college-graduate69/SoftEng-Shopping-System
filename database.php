<?php 
     $db = new mysqli ('localhost', 'root', '', 'shopping'); 
        if($db->connect_error){
            die('Connection Failure' . $db->connect_error);
        }

        function CheckUser(){
            if(isset($_SESSION['signeduser'])){
                if($_SESSION['userlevel'] == "Admin"){
                        header("location: admin-sales-report.php");
                    }
                }
        }

        function AdminCheck(){
            if(isset($_SESSION['signeduser'])){
            if($_SESSION['userlevel'] != "Admin"){
                header("location: index.php");
            }
        }
        }
?>