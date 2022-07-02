<?php
    //include constants file to use constant variables like SITEURL
    include('config/constants.php');

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
            <div class="thankyounote">
                <div class="note">
                    <p class="text-center">Thank You for Shopping with electro store. Your order will be delivered to You within 3 days if you are around
                        Nairobi, Mombasa and Kisumu. Welcome back again to shop with us.
                    </p>
                </div>
            </div>
        </section>

        <section class="section-main">
            <div class="special-offer-container">
                <div class="special-offer-card">
                    <div class="special-offer-gif">
                        <img src="images/categories/special offer gif.gif" alt="special offer gif" class="img-responsive">
                    </div>
                    <div class="special-offer-description">
                        <div class="top">
                            <img src="images/products/hp_desktop_cpu.jpg" alt="product image" width="50%">
                            <h3 style="font-size: 13px;">Hp desktop CPU</h3>
                            <div class="rating text-center">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <div class="text-center">
                                <small style="color: red;"><s>Ksh. 55455</s></small>
                                <h4 style="color: green;">Ksh. 27,727</h4>
                            </div>
                        </div>
                        <p style="color: #4949e0; font-weight: bold;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad minus tenetur esse deleniti, modi suscipit in quo, architecto maxime totam, quidem sint dolores? Eos incidunt labore quae, et excepturi perspiciatis.</p>
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