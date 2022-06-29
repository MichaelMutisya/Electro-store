<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');
    //include file category card to use card componets for categories
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
    <title>Electro Store - All Categories </title>
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
                <h3>CATEGORIES</h3>
            </div>
            <div class="row text-center">
                <?php
                    //SQL query to select all data from categories table 
                    $sql = "SELECT * FROM `tbl_categories` WHERE `active`='Yes'";

                    //execute the query 
                    $res = mysqli_query($conn, $sql);

                    //count the number of categories in the database
                    $count = mysqli_num_rows($res);

                    //check if the categories table has records
                    if($count > 1){
                        //there is data loop and print data on the page
                        while($rows = mysqli_fetch_assoc($res)){
                            $category_id = $rows['category_id'];
                            $category_name = $rows['category_name'];
                            $image_name = $rows['image_name'];
                            
                            categoryCard("$category_name", "$image_name",$category_id);
                        }
                    }
                    else{
                        //there is no data print no category available now
                        echo "<div class='error text-center'>There is no active categories available now!</div>";
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