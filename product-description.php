<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');
    //inlude product card file to use it on similar products section
    include('partials/product-card.php')
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
            <div class="product-description">
                <div class="product-image-description">
                    <img src="images/products/Kitchen Appliances320.jpg" class="img-responsive">
                </div>
                <div class="short-description">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint quas fugit labore! Eos hic, veritatis illo ab aliquid tempora aperiam nostrum quod fuga, eaque, dolor excepturi pariatur reprehenderit perspiciatis minima.</p>
                    <form action="index.php">
                        <button type="submit" class="primary" name="add">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                    </form>
                </div>
            </div>
            <div class="long-description">
                <h4>More description</h4>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores sunt commodi sapiente cum laudantium perspiciatis quam magni eveniet minima consectetur dolores nam soluta fugiat reiciendis veritatis nisi, suscipit odio! Tenetur. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non sint, minima perspiciatis nulla a possimus nemo fuga at corrupti unde minus, maiores expedita qui eaque quia. Sunt at consequuntur iusto? Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus saepe corrupti tempore nulla, nihil quaerat, asperiores aliquid ipsam dolorem obcaecati inventore placeat eum alias libero consequatur illo cupiditate earum modi!</p>
            </div>
        </section>
        <section class="section-main">
            <div class="title text-center">
                <h3>Similar Products</h3>
                <?php
                    //SQL query to select similar products 
                    //$sql = "SELECT * FROM `tbl_products` WHERE `category_name`='$category_name' OR ";
                    productCard($image_name, $product_name, $short_description, $old_price, $new_price);
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