<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');
    //include product card file to access product card function
    include('partials/product-card.php');
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
                <h3>Search Page</h3>
            </div>
            <h3 class="text-center">You searched for"<?php $product_searched = mysqli_real_escape_string($conn,$_GET['product_searched']); echo $product_searched; ?>"</h3>
            <div class="row text-center">
                <?php
                    //check if search button is clicked
                    if(isset($_GET['search'])){
                        //get the product searched
                        $product_searched = mysqli_real_escape_string($conn,$_GET['product_searched']);

                        //check if product searched is empty
                        if(!$product_searched == ""){
                            //check if product searched is set
                            //SQL query to select product name, category name,
                            //short description and long description words that match the search
                            $sql = "SELECT * FROM `tbl_products` 
                            WHERE `product_name` LIKE '%$product_searched%' 
                            OR `category_name` lIKE '%$product_searched%' 
                            OR `short_description` LIKE '%$product_searched%' 
                            OR`long_description` LIKE '%$product_searched%'";

                            //execute the query
                            $res = mysqli_query($conn, $sql);

                            //count the number of products in the database
                            $count = mysqli_num_rows($res);

                            //check if the products table has records
                            if($count > 0){
                                //there is data loop and print data on the page
                                while($rows = mysqli_fetch_assoc($res)){
                                    $product_name = $rows['product_name'];
                                    $image_name = $rows['image_name'];
                                    $short_description = $rows['short_description'];
                                    $old_price = $rows['original_price'];
                                    $new_price = $rows['price'];
                                        
                                    productCard($image_name, $product_name, $short_description, $old_price, $new_price);
                                }
                            }
                            else{
                                //there is no data print no products available now
                                echo "<div class='error text-center'>There is no product with ".$product_searched." name!</div>";
                            }
                        }
                        else{
                            echo "<div class='error'>You entered nothing on the search input. Try again!</div>";
                        } 
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