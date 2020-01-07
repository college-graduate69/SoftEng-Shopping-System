<?php
class reports{
    function __construct($db){
        $this->db = $db;
    }
    
    function getStocks(){
        $products = [];
        $stmt = $this->db->prepare("SELECT prod_id, prod_name, prod_qty FROM products");
        $stmt->execute();
        $stmt->bind_result($productId, $productName, $productQty);
        $stmt->store_result();
        while($stmt->fetch()){
            array_push($products,['productId' => $productId, 'productName' => $productName, 'productQty' => $productQty]);
        }
        $stmt->close();
        return $products;
    }

    function getWeekly($startDate, $endDate) {
        $transaction = [];
        $stmt = $this->db->prepare("SELECT DISTINCT transaction_date FROM product_transaction WHERE transaction_date >= ? AND transaction_date <= ?  ORDER BY transaction_date ASC");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $stmt->bind_result($transDate);
        $stmt->store_result();

        while($stmt->fetch()){
            $products = [];
            $stmt2 = $this->db->prepare("SELECT DISTINCT prod_id FROM product_transaction WHERE transaction_date = ?");
            $stmt2->bind_param('s', $transDate);
            $stmt2->execute();
            $stmt2->bind_result($productId);
            $stmt2->store_result();
            while($stmt2->fetch()){
                $qty = 0;
                $price = 0;
                $stmt3 = $this->db->prepare("SELECT transaction_id, prod_qty, prod_price FROM product_transaction WHERE prod_id = ? AND transaction_date = ?");
                $stmt3->bind_param('is', $productId, $transDate);
                $stmt3->execute();
                $stmt3->bind_result($transactionID, $productQty, $productPrice);
                $stmt3->store_result();
                while($stmt3->fetch()){
                    $qty = $qty + $productQty;
                    $price = $price + $productPrice;
                }
                $stmt3->close();
                $stmt4 = $this->db->prepare("SELECT prod_name, prod_type FROM products WHERE prod_id = ?");
                $stmt4->bind_param('i', $productId);
                $stmt4->execute();
                $stmt4->bind_result($productName, $productType);
                $stmt4->store_result();
                while($stmt4->fetch()) {
                    array_push($products, ['transactionId'=>$transactionID, 'productName'=>$productName, 'productType'=>$productType, 'productQty'=>$qty, 'total'=>$price]);
                }
                $stmt4->close();
            }
            $stmt2->close();
            array_push($transaction, ['dates'=>$transDate, 'products'=>$products]);
        }
        $stmt->close();
        return $transaction;

    }
    function getWeeklySummary($startDate, $endDate) {
  
        $summary = [];
        $stmt = $this->db->prepare("SELECT DISTINCT prod_id FROM product_transaction WHERE transaction_date >= ? AND transaction_date <= ?");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $stmt->bind_result($productId);
        $stmt->store_result();
        while($stmt->fetch()) {
            $qty = 0;
            $price = 0;
            $stmt2 = $this->db->prepare("SELECT prod_qty, prod_price FROM product_transaction WHERE prod_id = ?");
            $stmt2->bind_param('i', $productId);
            $stmt2->execute();
            $stmt2->bind_result($productQty, $productPrice);
            while($stmt2->fetch()) {
                $qty = $qty + $productQty;
                $price = $price + $productPrice;
            }
            $stmt2->close();

            $stmt3 = $this->db->prepare("SELECT prod_name FROM products WHERE prod_id = ?");
            $stmt3->bind_param('i', $productId);
            $stmt3->execute();
            $stmt3->bind_result($productName);
            while($stmt3->fetch()) {
                array_push($summary, ['productName'=>$productName, 'productQty'=>$qty, 'productPrice'=>$price]);
            }
            $stmt3->close();
        }
        $stmt->close();
        return $summary;
    }
    function getWeeklyCategory($startDate, $endDate){
        $category = [];

        $stmt = $this->db->prepare("SELECT DISTINCT prod_type FROM product_transaction WHERE transaction_date >= ? AND transaction_date <= ?");
        $stmt->bind_param('ss', $startDate, $endDate);
        $stmt->execute();
        $stmt->bind_result($productType);
        $stmt->store_result();
        while($stmt->fetch()) {
            $qty = 0;
            $stmt2 = $this->db->prepare("SELECT prod_qty FROM product_transaction WHERE prod_type = ?");
            $stmt2->bind_param('s', $productType);
            $stmt2->execute();
            $stmt2->bind_result($productQty);
            while($stmt2->fetch()) {
                $qty = $qty + $productQty;
            }
            $stmt2->close();
            array_push($category, ['productType'=>$productType, 'productQty'=>$qty]);
        }
        $stmt->close();
        return $category;

    }
    function getMonthly($month, $year) {
        $transaction = [];
        $stmt = $this->db->prepare("SELECT DISTINCT transaction_date FROM product_transaction WHERE MONTH(transaction_date) = ? AND YEAR(transaction_date) = ?  ORDER BY transaction_date ASC");
        $stmt->bind_param('ss', $month, $year);
        $stmt->execute();
        $stmt->bind_result($transDate);
        $stmt->store_result();
        
        while($stmt->fetch()) {
        
            $products = [];
            $stmt2 = $this->db->prepare("SELECT DISTINCT prod_id FROM product_transaction WHERE transaction_date = ?");
            $stmt2->bind_param('s', $transDate);
            $stmt2->execute();
            $stmt2->bind_result($productId);
            $stmt2->store_result();
            while($stmt2->fetch()) {
                
                $qty = 0;
                $price = 0;
                $stmt3 = $this->db->prepare("SELECT transaction_id, prod_qty, prod_price FROM product_transaction WHERE prod_id = ? AND transaction_date = ?");
                $stmt3->bind_param('is', $productId, $transDate);
                $stmt3->execute();
                $stmt3->bind_result($transactionID, $productQty, $productPrice);
                $stmt3->store_result();
                while($stmt3->fetch()) {
                    $qty = $qty + $productQty;
                    $price = $price + $productPrice;
                }
                $stmt3->close();
                $stmt4 = $this->db->prepare("SELECT prod_name, prod_type FROM products WHERE prod_id = ?");
                $stmt4->bind_param('i', $productId);
                $stmt4->execute();
                $stmt4->bind_result($productName, $productType);
                $stmt4->store_result();
                while($stmt4->fetch()) {
                    array_push($products, ['transactionId'=>$transactionID,'productName'=>$productName,'productType'=>$productType, 'productQty'=>$qty, 'total'=>$price]);
                }
                $stmt4->close();
            }
            $stmt2->close();
            array_push($transaction, ['dates'=>$transDate, 'products'=>$products]);
        }
        $stmt->close();
        return $transaction;
    }
    function getMonthlySummary($month, $year) {
  
        $summary = [];
        $stmt = $this->db->prepare("SELECT DISTINCT prod_id FROM product_transaction WHERE MONTH(transaction_date) = ? AND YEAR(transaction_date) = ?");
        $stmt->bind_param('ss', $month, $year);
        $stmt->execute();
        $stmt->bind_result($productId);
        $stmt->store_result();
        while($stmt->fetch()) {
            $qty = 0;
            $price = 0;
            $stmt2 = $this->db->prepare("SELECT prod_qty, prod_price FROM product_transaction WHERE prod_id = ?");
            $stmt2->bind_param('i', $productId);
            $stmt2->execute();
            $stmt2->bind_result($productQty, $productPrice);
            while($stmt2->fetch()) {
                $qty = $qty + $productQty;
                $price = $price + $productPrice;
            }
            $stmt2->close();

            $stmt3 = $this->db->prepare("SELECT prod_name FROM products WHERE prod_id = ?");
            $stmt3->bind_param('i', $productId);
            $stmt3->execute();
            $stmt3->bind_result($productName);
            while($stmt3->fetch()) {
                array_push($summary, ['productName'=>$productName, 'productQty'=>$qty, 'productPrice'=>$price]);
            }
            $stmt3->close();
        }
        $stmt->close();
        return $summary;
    }
    function getMonthlyCategory($month, $year){
        $category = [];

        $stmt = $this->db->prepare("SELECT DISTINCT prod_type FROM product_transaction WHERE MONTH(transaction_date) = ? AND YEAR(transaction_date) = ?");
        $stmt->bind_param('ss', $month, $year);
        $stmt->execute();
        $stmt->bind_result($productType);
        $stmt->store_result();
        while($stmt->fetch()) {
            $qty = 0;
            $stmt2 = $this->db->prepare("SELECT prod_qty FROM product_transaction WHERE prod_type = ?");
            $stmt2->bind_param('s', $productType);
            $stmt2->execute();
            $stmt2->bind_result($productQty);
            while($stmt2->fetch()) {
                $qty = $qty + $productQty;
            }
            $stmt2->close();
            array_push($category, ['productType'=>$productType, 'productQty'=>$qty]);
        }
        $stmt->close();
        return $category;
    }
    function getYearly($year) {
        $transaction = [];
        $stmt = $this->db->prepare("SELECT DISTINCT MONTH(transaction_date) FROM product_transaction WHERE YEAR(transaction_date) = ? ORDER BY MONTH(transaction_date) ASC");
        $stmt->bind_param('s', $year);
        $stmt->execute();
        $stmt->bind_result($month);
        $stmt->store_result();
        while($stmt->fetch()) {
            $stmt2 = $this->db->prepare("SELECT DISTINCT prod_id FROM product_transaction WHERE MONTH(transaction_date) = ?");
            $stmt2->bind_param('s', $month);
            $stmt2->execute();
            $stmt2->bind_result($productId);
            $stmt2->store_result();
            
            $products = [];
            while($stmt2->fetch()) {
                $qty = 0;
            $price = 0;
                $stmt3 = $this->db->prepare("SELECT transaction_id, prod_qty, prod_price FROM product_transaction WHERE prod_id = ? AND MONTH(transaction_date) = ?");
                $stmt3->bind_param('ii', $productId, $month);
                $stmt3->execute();
                $stmt3->bind_result($transactionID, $productQty, $productPrice);
                $stmt3->store_result();
                while($stmt3->fetch()) {
                    $qty = $qty + $productQty;
                    $price = $price + $productPrice;
                }
                $stmt3->close();

                $stmt4 = $this->db->prepare("SELECT prod_name, prod_type FROM products WHERE prod_id = ?");
                $stmt4->bind_param('i', $productId);
                $stmt4->execute();
                $stmt4->bind_result($productName, $productType);
                while($stmt4->fetch()) {
                    array_push($products, ['transactionId'=>$transactionID, 'productName'=>$productName,'productType'=>$productType, 'productQty'=>$qty, 'total'=>$price]);
                }
                $stmt4->close();
            }
            $stmt2->close();
            $monthNum  = $month;
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F');
            array_push($transaction, ['dates'=>$monthName, 'products'=>$products]);
        }
        $stmt->close();
        return $transaction;
    }
    function getYearlySummary($year) {
  
        $summary = [];
        $stmt = $this->db->prepare("SELECT DISTINCT prod_id FROM product_transaction WHERE YEAR(transaction_date) = ?");
        $stmt->bind_param('s', $year);
        $stmt->execute();
        $stmt->bind_result($productId);
        $stmt->store_result();
        while($stmt->fetch()) {
            $qty = 0;
            $price = 0;
            $stmt2 = $this->db->prepare("SELECT prod_qty, prod_price FROM product_transaction WHERE prod_id = ?");
            $stmt2->bind_param('i', $productId);
            $stmt2->execute();
            $stmt2->bind_result($productQty, $productPrice);
            while($stmt2->fetch()) {
                $qty = $qty + $productQty;
                $price = $price + $productPrice;
            }
            $stmt2->close();

            $stmt3 = $this->db->prepare("SELECT prod_name FROM products WHERE prod_id = ?");
            $stmt3->bind_param('i', $productId);
            $stmt3->execute();
            $stmt3->bind_result($productName);
            while($stmt3->fetch()) {
                array_push($summary, ['productName'=>$productName, 'productQty'=>$qty, 'productPrice'=>$price]);
            }
            $stmt3->close();
        }
        $stmt->close();
        return $summary;
    }
    function getYearlyCategory($year){
        $category = [];
        $stmt = $this->db->prepare("SELECT DISTINCT prod_type FROM product_transaction WHERE YEAR(transaction_date) = ?");
        $stmt->bind_param('s', $year);
        $stmt->execute();
        $stmt->bind_result($productType);
        $stmt->store_result();
        while($stmt->fetch()) {
            $qty = 0;
            $stmt2 = $this->db->prepare("SELECT prod_qty FROM product_transaction WHERE prod_type = ?");
            $stmt2->bind_param('s', $productType);
            $stmt2->execute();
            $stmt2->bind_result($productQty);
            while($stmt2->fetch()) {
                $qty = $qty + $productQty;
            }
            $stmt2->close();
            array_push($category, ['productType'=>$productType, 'productQty'=>$qty]);
        }
        $stmt->close();
        return $category;
    }    
}