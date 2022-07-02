<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');

    //include file product card and category card to use card componets for products and categories
    include('partials/product-card.php');
    include('partials/category-card.php');
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
    <title>Electro Store - Shop for the high quality electronics appliances </title>
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
    <!--menu-section starts here section-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here section-->

    <!--main-section starts here section-->
    <main id="top-section" class="main-section wrapper">
        <section class="section-main">
            <div class="title text-center">
                <h3>FEATURED CATEGORIES</h3>
            </div>
            <div class="row text-center">
                <?php
                    //SQL query to select all data from categories table 
                    $sql = "SELECT * FROM `tbl_categories` WHERE `active`='Yes' AND `featured`='Yes' LIMIT 3";

                    //execute the query 
                    $res = mysqli_query($conn, $sql);

                    //count the number of categories in the database
                    $count = mysqli_num_rows($res);

                    //check if the categories table has records
                    if($count > 0){
                        //there is data loop and print data on the page
                        while($rows = mysqli_fetch_assoc($res)){
                            $category_id = $rows['category_id'];
                            $category_name = $rows['category_name'];
                            $image_name = $rows['image_name'];
                            
                            categoryCard("$category_name", "$image_name", $category_id);
                        }
                    }
                    else{
                        //there is no data print no categories available now
                        echo "<div class='error text-center'>There is no featured categories available now!</div>";
                    }              
                ?>
            </div>
        </section>

        <section class="section-main">
            <div class="title text-center">
                <h3>FEATURED PRODUCTS</h3>
            </div>
            <div class="product-row container-wrapper text-center">
                <?php
                    //SQL query to select all data from products table 
                    $sql = "SELECT * FROM `tbl_products` WHERE `active`='Yes' AND `featured`='Yes' LIMIT 20";

                    //execute the query 
                    $res = mysqli_query($conn, $sql);

                    //count the number of products in the database
                    $count = mysqli_num_rows($res);

                    //check if the products table has records
                    if($count > 1){
                        //there is data loop and print data on the page
                        while($rows = mysqli_fetch_assoc($res)){
                            $product_id = $rows['product_id'];
                            $product_name = $rows['product_name'];
                            $image_name = $rows['image_name'];
                            $short_description = $rows['short_description'];
                            $old_price = $rows['original_price'];
                            $new_price = $rows['price'];
                            
                            productCard($image_name, $product_name, $short_description, $old_price, $new_price, $product_id);
                        }
                    }
                    else{
                        //there is no data print no products available now
                        echo "<div class='error text-center'>There is no featured products available now!</div>";
                    }
                ?>     
            </div>
        </section>

        <section class="section-main">
            <div class="title text-center">
                <h3>LATEST PRODUCTS</h3>
            </div>
            <div class="product-row container-wrapper text-center">
                <?php
                    //SQL query to select all data from products table 
                    $sql = "SELECT * FROM `tbl_products` WHERE `active`='Yes' AND `featured`='Yes' LIMIT 20";

                    //execute the query 
                    $res = mysqli_query($conn, $sql);

                    //count the number of products in the database
                    $count = mysqli_num_rows($res);

                    //check if the products table has records
                    if($count > 1){
                        //there is data loop and print data on the page
                        while($rows = mysqli_fetch_assoc($res)){
                            $product_id = $rows['product_id'];
                            $product_name = $rows['product_name'];
                            $image_name = $rows['image_name'];
                            $short_description = $rows['short_description'];
                            $old_price = $rows['original_price'];
                            $new_price = $rows['price'];
                            
                            productCard($image_name, $product_name, $short_description, $old_price, $new_price, $product_id);
                        }
                    }
                    else{
                        //there is no data print no products available now
                        echo "<div class='error text-center'>There is no latest products available now!</div>";
                    }  
                ?>
            </div>
        </section>

        <section class="section-main">
            <div class="title text-center">
                <h3>SPECIAL OFFER</h3>
            </div>
            <div class="special-offer-container">
                <div class="special-offer-card">
                    <div class="special-offer-gif">
                        <img src="images/categories/special offer gif.gif" alt="special offer gif" class="img-responsive">
                    </div>
                    <div class="special-offer-description">
                        <div class="top">
                            <img src="images\products\Apple airpods107.jpg" alt="product image" width="50%">
                            <h3 style="font-size: 13px;">Apple airpods pro</h3>
                            <div class="rating text-center">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="text-center">
                                <small style="color: red;"><s>Ksh.12343</s></small>
                                <h4 style="color: green;">Ksh. 6055</h4>
                            </div>
                        </div>
                        <p style="color: #4949e0; font-weight: bold;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad minus tenetur esse deleniti, modi suscipit in quo, architecto maxime totam, quidem sint dolores? Eos incidunt labore quae, et excepturi perspiciatis.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-main">
            <div class="title text-center">
                <h3>POPULAR BRANDS</h3>
            </div>
            <div class="brads-container">
                <marquee behavior="" direction="rtl">
                    <div class="brads">
                        <img src="https://img.icons8.com/color/48/undefined/hp.png"/>
                        <img src="https://img.icons8.com/color/48/undefined/dell--v1.png"/>
                        <img src="https://img.icons8.com/color/48/undefined/samsung.png"/>
                        <img src="images/logos/huaweii_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/sony_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/hisense_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/phillips_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/canon_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/jbl_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/ramtons_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/asus_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/xbox_logo.png" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/armco_logo.jpg" style="width: 70px; height: 70px" title="logo">
                        <img src="images/logos/apple_logo.png" style="width: 70px; height: 70px" title="logo">
                    </div>
                </marquee>
            </div>
        </section>
    </main>
    <!--main-section ends here section-->
    
    <!--footer-section starts here section-->
    <?php include('partials/footer.php'); ?>
    <!--footer-section ends here section-->
</body>
<!-- Links for free icons from icons8 -->
<?php include('partials/freeiconslinks.php'); ?>
</html>