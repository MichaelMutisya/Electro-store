<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');

    //include file cart product to use card componets for products in the cart to display
    include('partials/cart-product.php');

    //include login check file to check if customer is login
    include('login-check.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META CHARSET --> 
    <meta charset="UTF-8">
    <!-- META EDGE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- META VIEWPORT -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>Electro Store - Shopping cart </title>
    <!-- META DESCRIPTION -->
    <meta name="description" content="Electro store is a shopping platform for the best and high quality of kitchen,office, 
    living room and other types of electronic for famous brands. We ensure satisfaction to our customer. We offer free 
    delivery on goods order amount above Ksh 500000 within Nairobi, Mombasa and Kisumu">
    <!-- META KEYWORDS -->
    <meta name="keywords" content="HP SAMSUNG SONY HISENSE DELL HUAWEII PHILLIPS RAMTONS ">
    <!-- META AUTHOR -->
    <meta name="author" content="Michael Mutisya">

    <!-- FAVICON-->
    <link  rel="shortcut icon" type="image/ico" href="images/favicon.ico">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CASCADING STYLE SHEET -->
    <link rel="stylesheet" href="css/style.css">

    <!-- JS SCRIPTS -->
    <script defer src="js/electrostoreapp.js"></script>
    
</head>
<body>
    <!--menu-section starts here-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here-->

    <!--main-section starts here-->
    <main id="top-section" class="main-section wrapper">
        <section class="section-main">
            <div class="shopping-cart">
                <h3>Cart <i class="fa fa-shopping-cart"></i></h3>
                <hr>
            </div>
            <div class="cart">
                <div class="cart-row">
                    <?php
                        //set product id
                        $product_id = array_column($_SESSION['cart'], 'product_id');
                        
                        //SQL query to select product data
                        $sql = "SELECT * FROM `tbl_productS` WHERE `active`='Yes' AND `featured`='Yes'";

                        //execute the query
                        $res = mysqli_query($conn, $sql);

                        //display products on the cart
                        while($rows = mysqli_fetch_assoc($res)){
                            $product_name = $rows['product_name'];
                            $image_name = $rows['image_name'];
                            $product_price = $rows['price'];
                            $active = $rows['active'];
                            $featured = $rows['featured'];
                            //check if the product is active
                            if($active == "Yes" && $featured == "Yes"){
                                foreach($product_id as $id){
                                    if($rows['product_id'] == $id){
                                        cartProduct($image_name, $product_name, $product_price);
                                    }
                                }
                            }else{
                                unset($rows['product_id']);
                            }
                        }                 
                    ?>
                </div>
                <div class="checkout">
                    <p class="text-center">Items ()</p>
                    <hr>
                    <div class="checkout-prices">
                        <h5>Price: </h5>
                        <h4>V.A.T: </h4>
                        <h5>Delivery fee: </h5>
                        <h3>Total Amount: </h3>
                        <button class="btn primary">CHECKOUT</button>
                    </div>
                </div>
            </div>
        </section>
    </main> 
    <!--main-section ends here-->

    <!--footer-section starts here-->
    <?php include('partials/footer.php'); ?>
    <!--footer-section ends here-->
</body>
<!-- Links for free icons from icons8 -->
<?php include('partials/freeiconslinks.php'); ?>
</html>