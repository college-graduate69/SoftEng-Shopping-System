<?php 
    class display {
        private $db;
        
        public function __construct($db){
            $this->db = $db;
        }

        function displayCategory() {
            $stmt = $this->db->prepare('SELECT id,Category FROM product_category');
            $stmt->execute();
            $stmt->bind_result($id,$type);
            $categories =[];
            while($stmt->fetch()){
                array_push($categories,["productCategory"=>$type, "id"=>$id]);
            }
            $stmt->close();
            return $categories;
        }

        function displayProducts(){
            $stmt = $this->db->prepare('SELECT prod_id, prod_name, prod_price, prod_qty, prod_type, prod_descrip, prod_img FROM products ORDER BY prod_name ASC');
            $stmt->execute();
            $stmt->bind_result($id,$name,$price,$qty,$prodType,$descrip,$image);
            $products = [];
            while($stmt->fetch()){
                array_push($products,["productID"=>$id,"productName"=>$name,"productQuantity"=>$qty,"productPrice"=>$price,"productType"=>$prodType,"productDesc"=>$descrip,"productImage"=>$image]);
            }
            return $products;
            $stmt->close();
        }

        function FilteredProduct($type) {
            $stmt = $this->db->prepare('SELECT prod_id, prod_name, prod_price, prod_qty, prod_type, prod_descrip, prod_img FROM products WHERE prod_type = ? ');
            $stmt->bind_param('s', $type);
            $stmt->execute();
            $stmt->bind_result($id,$name,$price,$qty,$prodType,$descrip,$image);
            $products = [];
            while($stmt->fetch()){
                array_push($products,["productID"=>$id,"productName"=>$name,"productQuantity"=>$qty,"productPrice"=>$price,"productType"=>$prodType,"productDesc"=>$descrip,"productImage"=>$image]);
            }
            return $products;
            $stmt->close();
        }

        function ProductItem($id){
            $stmt = $this->db->prepare('SELECT prod_name, prod_price, prod_qty, qty_s, qty_m, qty_l , prod_type, prod_descrip, prod_img FROM products WHERE prod_id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->bind_result($name, $price, $qty, $qty_s, $qty_m, $qty_l, $type, $descrip, $img);
            $products = [];
            while($stmt->fetch()){
                array_push($products, ["productName"=>$name, "productPrice"=>$price, "productQuantity"=>$qty,"QuantityS"=>$qty_s, "QuantityM"=>$qty_m, "QuantityL"=>$qty_l , "productType"=>$type, "productInfo"=>$descrip, "ProductImg"=>$img]);
            }
            $stmt->close();
            return $products;
        }

        function displayTransactions(){
            $status = 'incomplete';
            $status2 = 'complete';
            $transaction = [];
            $details = [];           

            $stmt = $this->db->prepare("SELECT status, user_id, id, billing, transaction_date FROM transaction WHERE status = ? OR status = ? ORDER BY transaction_date ASC");
            $stmt->bind_param('ss', $status, $status2);

            $stmt->execute();
            $stmt->bind_result($transStatus,$userId,$transId,$billing,$transDate);
            $stmt->store_result();
            while($stmt->fetch()){
                $products = [];
                $stmt2 = $this->db->prepare("SELECT prod_id, prod_qty, prod_price FROM product_transaction WHERE transaction_id = ?");
                $stmt2->bind_param('i',$transId);
                $stmt2->execute();
                $stmt2->bind_result($productId,$productQty,$productPrice);
                $stmt2->store_result();
                $price = 0;
                while($stmt2->fetch()){
                    $price = $price + $productPrice;
                    $stmt3 = $this->db->prepare("SELECT prod_name from products WHERE prod_id = ?");
                    $stmt3->bind_param('i', $productId);
                    $stmt3->execute();
                    $stmt3->bind_result($productName);
                    while($stmt3->fetch()){
                        array_push($products, ['productName'=>$productName, 'ProductQty'=>$productQty, 'productPrice'=>$productPrice]);        
                    }
                    $stmt3->close();
                }
                $stmt2->close();

                $stmt4 = $this->db->prepare("SELECT user_address, full_name, email from users WHERE id = ?");
                $stmt4->bind_param('i', $userId);
                $stmt4->execute();
                $stmt4->bind_result($address,$fullname,$contact);
                while($stmt4->fetch()){
                    array_push($details, ['status'=>$transStatus, 'transactionId'=>$transId, 'address'=>$billing, 'fullName'=>$fullname, 'total'=>$price, 'products'=>$products, 'contact'=>$contact, 'transactionDate'=>$transDate]);   
                }
                $stmt4->close();
            }
            $stmt->close();

            array_push($transaction, ['details'=>$details]);
            return $transaction;
        }

        function displayCustomerTransaction() {
            $transaction = [];
            $total = 0;
            $status = 'incomplete';
            $stmt = $this->db->prepare("SELECT id, transaction_date, billing FROM transaction WHERE user_id = ? AND status = ? ORDER BY transaction_date ASC");
            $stmt->bind_param('is',$_SESSION['signeduser'], $status);
            $stmt->execute();
            $stmt->bind_result($transId, $transDate, $billingAddress);
            $stmt->store_result();
            while($stmt->fetch()) {
                $products = [];
                $stmt2 = $this->db->prepare("SELECT prod_id, prod_qty, prod_price FROM product_transaction WHERE transaction_id = ?");
                $stmt2->bind_param('i', $transId);
                $stmt2->execute();
                $stmt2->bind_result($productId, $productQty, $productPrice);
                $stmt2->store_result();
                while($stmt2->fetch()) {
                    $price = 0;
                    $price = $price + $productPrice;
                    $total = $total + $price;
                    $stmt3 = $this->db->prepare("SELECT prod_name FROM products WHERE prod_id = ?");
                    $stmt3->bind_param('i', $productId);
                    $stmt3->execute();
                    $stmt3->bind_result($productName);
                    while($stmt3->fetch()) {
                        
                        array_push($products, ['productName'=>$productName, 'productQty'=>$productQty, 'productPrice'=>$price]);
                    }
                    
                    $stmt3->close();
                    
                }
                
                $stmt2->close();
                array_push($transaction,['products'=>$products, 'total'=>$total, 'transactionId'=>$transId, 'transactionDate'=>$transDate, 'billingAdd'=>$billingAddress]);
                $total = 0;
            }
            $stmt->close();
        
            return $transaction;
        }

}