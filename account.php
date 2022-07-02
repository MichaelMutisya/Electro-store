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
    <title>Electro Store - Customer account status</title>
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
        <section class="customer-information text-center">
            <?php
                //check if customer id session variable is set
                if(isset($_SESSION['customer_id'])){
                    //set customer variable
                    $customer_id = $_SESSION['customer_id'];

                    //SQL query to to select customer data from the database
                    $sql = "SELECT * FROM `tbl_customers` WHERE `customer_id`='$customer_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //store the data collected from the database in an array
                    $row = mysqli_fetch_assoc($res);

                    //set names of data of customer you want to use from the databas
                    $customer_name = $row['name'];
                    $customer_email = $row['email'];
                    $customer_phone_number = $row['phone_number'];
                }
            ?>
            <h3>Customer Personal Information</h3>
            <div class="information">
                <h5><span>Email: </span><?php echo $customer_email; ?><a href="#"> Edit</a></h5>
                <h5><span>Name: </span><?php echo $customer_name; ?><a href="#"> Edit</a></h5>
                <h5><span>Phone No. </span><?php echo $customer_phone_number; ?><a href="#"> Edit</a></h5>
            </div>
        </section>
        <h3 class="text-center">Orders</h3>
        <section class="orders-status text-center">
            <div class="orders">
                <a href="<?php echo SITEURL; ?>customer-orders.php">
                    <div class="order3">
                        <h5>Pending</h5>
                    </div>
                </a>
                <a href="<?php echo SITEURL; ?>customer-orders.php">
                    <div class="order3">
                        <h5>Cancelled</h5>
                    </div>
                </a>
                <a href="<?php echo SITEURL; ?>customer-orders.php">
                    <div class="order3">
                        <h5>On way</h5>
                    </div>
                </a>
                <a href="<?php echo SITEURL; ?>customer-orders.php">
                    <div class="order3">
                        <h5>Delivered</h5>
                    </div>
                </a>
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