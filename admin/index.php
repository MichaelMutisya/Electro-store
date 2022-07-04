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
    <title>Electro Store - Admin control panel dashboard </title>
    <!-- META DESCRIPTION -->
    <meta name="description" content="Electro store is a shopping platform for the best and high quality of kitchen,office, 
    living room and other types of electronic for famous brands. We ensure satisfaction to our customer. We offer free 
    delivery on goods order amount above Ksh 500000 within Nairobi, Mombasa and Kisumu">
    <!-- META KEYWORDS -->
    <meta name="keywords" content="HP SAMSUNG SONY HISENSE DELL HUAWEII PHILLIPS RAMTONS ">
    <!-- META AUTHOR -->
    <meta name="author" content="Michael Mutisya">

    <!-- FAVICON-->
    <link  rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CASCADING STYLE SHEET -->
    <link rel="stylesheet" href="../css/admin.css"> 

    <!-- JS SCRIPTS -->
    <script defer src="../js/electrostoreapp.js"></script>
</head>
<body>
    <!--menu-section starts here section-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here section-->

    <!--main-section starts here section-->
    <section class="main-section">
        <div class="wrapper">
            <h3 class="dashboard-head">Dashboard</h3>
            <?php
                //SQL queries to select all customers and orders
                $sql = "SELECT * FROM `tbl_customers` WHERE 1";
                $sql2 = "SELECT * FROM `tbl_orders` WHERE 1";

                //execute the queries
                $res = mysqli_query($conn, $sql);
                $res2 = mysqli_query($conn, $sql2);

                //count numbers of rows in each table; customers table, products table and orders table
                $number_of_customers = mysqli_num_rows($res);
                $number_of_orders = mysqli_num_rows($res2);

                //initialize the total revunue 
                $total_revenue = 0;
                $number_of_products_sold =0;
                //add all orders total amount to get the total revenue
                //check if the order table is empty
                if($number_of_orders > 0){
                    while($rows = mysqli_fetch_assoc($res2)){
                        $total_amount = $rows['total_amount'];
                        $number_of_products = $rows['no._of_products'];
                        $number_of_products_sold = $number_of_products_sold + $number_of_products;
                        $total_revenue = $total_revenue + $total_amount;
                    }
                }
            ?>
            <div class="container">
                <div class="card">
                    <h4>Number of Customers</h4>
                    <h1><?php echo $number_of_customers; ?></h1>
                </div>
                <div class="card">
                    <h4>Products Sold</h4>
                    <h1><?php echo $number_of_products_sold; ?></h1>
                </div>
                <div class="card">
                    <h4>Number of Orders</h4>
                    <h1><?php echo $number_of_orders; ?></h1>
                </div>
                <div class="card">
                    <h4>Total Revenue</h4>
                    <h1><?php echo "Ksh.".$total_revenue; ?></h1>
                </div>
            </div>
        </div>
    </section>
    <!--main-section ends here section-->
    
    <!--footer-section starts here section-->
    <?php include('partials/footer.php'); ?>
    <!--footer-section ends here section-->
</body>
</html>