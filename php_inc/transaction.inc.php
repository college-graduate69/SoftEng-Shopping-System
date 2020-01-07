<?php
class transaction {
    private $db;
    private $dateToday;
    private $userID;
    private $userAddress;

    function __construct($db, $dateToday, $userID, $userAddress) {
        $this->db = $db;
        $this->dateToday = $dateToday;
        $this->userID = $userID;
        $this->userAddress = $userAddress;
    }

    function submitOrder(){
        $status = "incomplete";
        $stmt = $this->db->prepare("INSERT INTO transaction (user_id, transaction_date, billing, status) VALUES (?,?,?,?)");
        $stmt->bind_param('isss', $this->userID, $this->dateToday, $this->userAddress,$status);
        $stmt->execute();
        $stmt->close();
    }

    function SubmitItems($productId, $productType, $productQty, $productPrice) {
             $stmt = $this->db->prepare("SELECT id FROM transaction WHERE transaction_date = ?");
             $stmt->bind_param('s', $this->dateToday);
             $stmt->execute();
             $stmt->bind_result($transacId);
             $stmt->store_result();
            while($stmt->fetch()) {
            $stmt2 = $this->db->prepare("INSERT INTO product_transaction (transaction_id, prod_id, prod_type, prod_qty, prod_price, transaction_date) VALUES (?,?,?,?,?,?)");
            $stmt2->bind_param('iisiis', $transacId,$productId,$productType,$productQty,$productPrice,$this->dateToday);
            $stmt2->execute();
            $stmt2->close();
            }
          $stmt->close();
    
            $stmt = $this->db->prepare("SELECT prod_qty FROM products WHERE prod_id = ?");
            $stmt->bind_param('i', $productId);
            $stmt->execute();
            $stmt->bind_result($qty);
            $stmt->store_result();
            while($stmt->fetch()){
                $qty = $qty - $productQty;
                $stmt2 = $this->db->prepare("UPDATE products SET prod_qty = ? WHERE prod_id = ?");
                $stmt2->bind_param('ii', $qty, $productId);
                $stmt2->execute();
                $stmt2->close();
            }
            $stmt->close();
    }








    
}