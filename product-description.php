<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');
    //inlude product card file to use it on similar products section
    include('partials/product-card.php');
    //inlude product description card file to display product description
    include('partials/product-description-card.php');
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
    <title>Electro Store - Product description </title>
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
            <div class="title text-center">
                <h3>Product description</h3>
            </div>
            <?php
                //check if product id is set
                if(isset($_GET['product_id'])){
                    //set the product id variable
                    $product_id = $_GET['product_id'];

                    //SQL query to select product record from the database
                    $sql = "SELECT * FROM `tbl_products` WHERE `product_id`=$product_id";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check if query executed
                    if($res == true){
                        
                        //display product description
                        while($rows = mysqli_fetch_assoc($res)){
                            //set the product data collected from the database to variables
                            $product_id = $rows['product_id'];
                            $product_name = $rows['product_name'];
                            $category_name = $rows['category_name'];
                            $image_name = $rows['image_name'];
                            $short_description = $rows['short_description'];
                            $long_description = $rows['long_description'];
                            $old_price = $rows['original_price'];
                            $new_price = $rows['price'];

                            //print the variables
                            productDescriptionCard($image_name, $product_name, $short_description, $long_description, $old_price, $new_price);
                        }
                    }
                    else{
                        echo "didn't execute";
                        die();
                        //display error message
                        echo "<div class='error text-center'>Something wrong happened!</div>";
                    }
                }
                else{
                    //redirect to homepage
                    echo "<script>window.location='index.php'</script>";
                }
            ?>
        </section>
        <section class="section-main">
            <div class="title text-center">
                <h3>Similar Products</h3>
            </div>
            <div class="similiar-products wrapper">
                <?php
                    //SQL query to select similar products 
                    $sql = "SELECT * FROM `tbl_products` WHERE `category_name`='$category_name' AND `product_id`!='$product_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check if the query executed
                    if($res == true){
                        //display similar products
                        while($rows = mysqli_fetch_assoc($res)){
                            //set data collected from the database to variables
                            $product_id = $rows['product_id'];
                            $product_name = $rows['product_name'];
                            $category_name = $rows['category_name'];
                            $image_name = $rows['image_name'];
                            $short_description = $rows['short_description'];
                            $long_description = $rows['long_description'];
                            $old_price = $rows['original_price'];
                            $new_price = $rows['price'];

                            productCard($image_name, $product_name, $short_description, $old_price, $new_price, $product_id);
                        }
                    }
                    else{
                        //display error message
                        echo "<div class='error text-center'>Something wrong happened!</div>";
                    }
                ?>
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