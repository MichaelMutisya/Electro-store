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
            <div class="checkout">
                <div class="payout-form">
                    <div>
                        <h5>Delivery Store Location (choose store near you):</h5>
                        <select name="pickup_station">
                            <?php
                                //SQL query to get store name and location to pick your order
                                $sql = "SELECT * FROM `tbl_stores` WHERE 1";
                                
                                //execute the query
                                $res = mysqli_query($conn, $sql);

                                //count to check if there is store records on the database
                                $count = mysqli_num_rows($res);

                                //check if there is data on there databse
                                if($count > 0){
                                    //loop the table and print all the records on the select option
                                    while($rows = mysqli_fetch_assoc($res)){
                                        //set the variables to hold data collected from the database
                                        $store_name = $rows['store_name'];
                                        $store_location = $rows['store_location'];

                                        ?>
                                        <option value="<?php echo $store_name." ". $store_location ?>"><?php echo $store_name." ". $store_location ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="payment-methods">
                        <div class="method">
                            <img src="images/logos/airtel_logo.png" title="airtel money" style="width: 100%; height: 100%;">
                            <button type="submit" class="btn primary">Procede</button>
                        </div>
                        <div class="method">
                            <img src="images/logos/mpesa_logo.png" title="mpesa" style="width: 100%; height: 100%;">
                            <button type="submit" class="btn primary">Procede</button>
                        </div>
                        <div class="method">
                            <img src="images/logos/paypal_logo.png" title="paypal" style="width: 100%; height: 100%;">
                            <button type="submit" class="btn primary">Procede</button>
                        </div>
                        <div class="method">
                            <img src="images/logos/visaNmastercard_logo.jpg" title="electronic payment cards" style="width: 100%; height: 100%;">
                            <button type="submit" class="btn primary">Procede</button>
                        </div>
                    </div>
                </div>

                <div class="payment-brands">
                    <h5>Payment Methods Available</h5>
                    <div class="brand">
                        <img src="images/logos/airtel_logo.png" title="airtel money" class="img-responsive" style="height: 120px;">
                    </div>
                    <div class="brand">
                        <img src="images/logos/mpesa_logo.png" title="mpesa" class="img-responsive" style="height: 120px;">
                    </div>
                    <div class="brand">
                        <img src="images/logos/paypal_logo.png" title="paypal" class="img-responsive" style="height: 120px;">
                    </div>
                    <div class="brand">
                        <img src="images/logos/visaNmastercard_logo.jpg" title="electronic payment cards" class="img-responsive" style="height: 120px;">
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