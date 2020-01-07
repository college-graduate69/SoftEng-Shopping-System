<?php
    require_once('autoload.php');
    AdminCheck();
    $products = new products($db);
    $productCategories = new Display($db);

   // if(isset($_POST['AddProductbtn'])) {
   //     $target = "images/product_images/".basename($_FILES['product_image']['name']);
   //     $products->addProducts($_POST['product_name'], $_POST['product_price'], $_POST['product_qty'], $_POST['product_type'], $_POST['product_description'], $_FILES['product_image']['name']);
   //     if(move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {  
    //    }
  //  }
    
    if(isset($_POST['AddProductbtn'])) {
        $target = "images/product_images/".basename($_FILES['product_image']['name']);
        $products->addProducts($_POST['product_name'], $_POST['product_price'], $_POST['product_qty'],$_POST['qty_s'], $_POST['qty_m'], $_POST['qty_l'], $_POST['product_type'], $_POST['product_description'], $_FILES['product_image']['name']);
        if(move_uploaded_file($_FILES['product_image']['tmp_name'], $target)) {  
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>:: Shoppping ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/admin.css" />
</head>
<body>
    <div class="verticalnav">
        <div class="adminlogo">
            <a href = "admin.php" class = "adminlogo"></a>
        </div>
        <ul class="navlist">
            <li><a href="admin-products.php" class="adminlinks">Products</a></li>
            <li><a href="admin-transaction.php" class="adminlinks">Orders</a></li>
            <li><a href="admin.php" class="adminlinks">Sales Reports</a></li>
            <?php if(isset($_SESSION['signeduser'])):?>
                        <li><a class="adminlinks" href="index.php?logout=1">LOGOUT</a></li>
                <?php endif; ?>
        </ul> 
    </div>
    <!--navbar ends here-->
    
    <div class="form-holder">
        <div class="formheader">
            Add Product Form
        </div>
        <form action="add-products.php"method ="post" enctype="multipart/form-data">
        <div class="forminput">
            <input type="text" name="product_name" placeholder="Product Name" class="prodtext" required>
            <input type="number" name="product_price" placeholder="Product Price" class="prodtext" required>
            <select name="product_type"  class="prodtext2" id="options">
            <?php foreach($productCategories->displayCategory() as $categories): ?>
             <option value='<?= $categories["productCategory"] ?>' ><?= $categories["productCategory"] ?> </option>
             <?php endforeach; ?>
            </select>
            <div id="qty_hidden" class="qty_sizes">
            <input type="number" min="0" max="100" name="qty_s" placeholder="Small" class="prodtext2" >
            <input type="number" min="0" max="100" name="qty_m" placeholder="Medium" class="prodtext2">
            <input type="number" min="0" max="100" name="qty_l" placeholder="Large" class="prodtext2">
            </div>
            <div id="qty">
            <input type="number" min="0" max="100" name="product_qty" placeholder=" Product Quantity" class="prodtext2">
           </div>
            <textarea name="product_description" placeholder="Description" class="prodtext3"></textarea>
            <input type="submit" name="AddProductbtn" placeholder="Add Product" class="prodsubmit" required>
        </div>
        <div class="formimg">
            <div class="imgupbtn">
                <input type="file" src="#" id="imgPrev" name="product_image" class="imginput"/>
                <label for ="imgPrev">Upload Image </label>
            </div>
            <div class="imgprev">
            <img class="imgprevholder" id="Imgview" src="#" alt="No Image" />
            </div>
        </div>
        </form>
    </div>

    <script src="java/bootstrap/jquery.min.js"></script>
    <script> 
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#Imgview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgPrev").change(function(){
        readURL(this);
    });

        
    $(function() {
    $('#qty_hidden').hide(); 
    $('#qty').show();
    $('#options').change(function(){
        if($('#options').val() == 'Clothes') {
            $('#qty_hidden').show(); 
            $('#qty').hide();
        } else {
            $('#qty_hidden').hide();
            $('#qty').show(); 
        } 
    });
});

    </script>
    </body>
</html>