<?php 
 class products {
     private $db;

     public function __construct($db){
         $this->db = $db;
     }

     public function addCategory($category) {
        $stmt = $this->db->prepare("INSERT INTO product_category (Category) VALUES (?)");
        $stmt->bind_param("s",$category);
        $stmt->execute();
        $stmt->close();

     }

     public function addProducts($name_prod, $price_prod, $qty_prod, $s_qty, $m_qty, $l_qty, $type_prod, $desc_prod, $image) {
        $stmt = $this->db->prepare("INSERT INTO products(prod_name, prod_price, prod_qty, qty_s, qty_m, qty_l, prod_type, prod_descrip, prod_img) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('siiiiisss',$name_prod, $price_prod, $qty_prod, $s_qty, $m_qty, $l_qty, $type_prod, $desc_prod, $image);
        $stmt->execute();
        $stmt->close();
    }

     function deleteItem($id,$url){
        $stmt = $this->db->prepare("DELETE FROM products WHERE prod_id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();
        header("location: $url");
    }
    
    function deleteCategory($id,$url){
        $stmt = $this->db->prepare("DELETE FROM product_category WHERE id = ?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();
        header("location: $url");
    }

    function updateProduct($quantity, $price, $id) {
        $stmt = $this->db->prepare("UPDATE products SET prod_qty = ?, prod_price = ? WHERE prod_id = ?");
        $stmt->bind_param('iii',$quantity, $price, $id);
        $stmt->execute();
        $stmt->close();
    }

    public function ItemCheck($id, $qty){
        $stmt = $this->db->prepare("SELECT prod_qty FROM products WHERE prod_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($productQty);
        while($stmt->fetch()){
            if(($productQty - $qty)  < 0) {
                return false;
            }
            return true;
        }
    }



 }



?>