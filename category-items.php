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
    <title>Electro Store - Category items </title>
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
                <?php
                    //check if category id is set
                    if(isset($_GET['category_id'])){
                        //get the id of the selected category
                        $category_id = $_GET['category_id'];

                        //SQL query to select all data from categories table 
                        $sql = "SELECT * FROM `tbl_categories` WHERE `category_id`='$category_id' AND `active`='Yes'";

                        //execute the query 
                        $res = mysqli_query($conn, $sql);
                        $rows = mysqli_fetch_assoc($res);
                        
                        //set category id
                        $category_id = $rows['category_id'];
                        $category_name = $rows['category_name'];
                    }
                    else{
                        //redirect to homepage
                        header('location:'.SITEURL.'index.php');
                    }
                ?>
                <h3><?php echo $category_name." Products";?></h3>
            </div>
            <div class="row text-center">
                <?php
                    //SQL query to select all data from categories table 
                    $sql2 = "SELECT * FROM `tbl_products` WHERE `category_name`='$category_name' AND `active`='Yes'";

                    //execute the query 
                    $res2 = mysqli_query($conn, $sql2);
        
                    //count the number of categories in the database
                    $count = mysqli_num_rows($res2);

                    //check if the categories table has records
                    if($count > 1){
                        //there is data loop and print data on the page
                        while($rows2 = mysqli_fetch_assoc($res2)){
                            $product_id = $rows2['product_id'];
                            $product_name = $rows2['product_name'];
                            $image_name = $rows2['image_name'];
                            $short_description = $rows2['short_description'];
                            $old_price = $rows2['original_price'];
                            $new_price = $rows2['price'];
                            
                            productCard($image_name, $product_name, $short_description, $old_price, $new_price, $product_id);
                        }
                    }
                    else{
                        //there is no data print no category available now
                        echo "<div class='error text-center'>There is no ".$category_name." products available now!</div>";
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