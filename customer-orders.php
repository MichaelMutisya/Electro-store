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
    <title>Electro Store - Customer orders status</title>
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
        <section class="text-center">
            <h3>Pending Orders</h3>
            <table class="tbl-100">
                <tr>
                    <th>S.N</th>
                    <th>Order Id</th>
                    <th>No.of Products</th>
                    <th>Products</th>
                    <th>Pickup Store</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Print order</th>
                </tr>
                <?php
                    //setting status of order and customer id
                    $order_status = "Pending";
                    $customer_id = $_SESSION['customer_id'];

                    //SQL query to select order id where order status is pending
                    $sql = "SELECT * FROM `tbl_orders` WHERE `status`='$order_status' AND `customer_id`='$customer_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the number of records of orders pending in the database
                    $count = mysqli_num_rows($res);

                    //check the number of records of orders pending in the database
                    if($count > 0){
                        //loop through the table to get all the records
                        while($row = mysqli_fetch_assoc($res)){
                            //set the data from the database to variables
                            $order_id = $row['order_id'];
                            $no_of_products_ordered = $row['no._of_products'];
                            $products = $row['products_name'];
                            $pick_up_store = $row['store_name'];
                            $store_location = $row['store_location'];
                            $date_order_placed = $row['order_date'];
                            $status = $row['status'];

                            //set order serial number
                            $sn = 1;
                            //print the data in the table
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td>#order1 <?php echo $order_id; ?></td>
                                    <td><?php echo $no_of_products_ordered; ?></td>
                                    <td><?php echo $products; ?></td>
                                    <td><?php echo $pick_up_store." "; ?><?php echo $store_location; ?></td>
                                    <td><?php echo $date_order_placed ?></td>
                                    <td class="status-pending"><?php echo $status; ?></td>
                                    <td>
                                        <a href="#" class="btn secondary">Print</a>
                                    </td>
                                </tr>
                            
                            <?php
                        }
                    }
                    else{
                        //print message there is no order pending
                        ?>
                        <tr>
                            <td colspan="8" style="color:purple;">There is no order pending</td>
                        </tr>
                        <?php
                    }
                ?>    
            </table>
        </section>
        <section class="text-center">
            <h3>Cancelled Orders</h3>
            <table class="tbl-100">
                <tr>
                    <th>S.N</th>
                    <th>Order Id</th>
                    <th>No.of Products</th>
                    <th>Products</th>
                    <th>Pickup Store</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Print order</th>
                </tr>
                <?php
                    //setting status of order and customer id
                    $order_status = "Cancelled";
                    $customer_id = $_SESSION['customer_id'];

                    //SQL query to select order id where order status is cancelled
                    $sql = "SELECT * FROM `tbl_orders` WHERE `status`='$$order_status' AND `customer_id`='$customer_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the number of records of orders cancelled in the database
                    $count = mysqli_num_rows($res);

                    //check the number of records of orders cancelled in the database
                    if($count > 0){
                        //loop through the table to get all the records
                        while($row = mysqli_fetch_assoc($res)){
                            //set the data from the database to variables
                            $order_id = $row['order_id'];
                            $no_of_products_ordered = $row['no._of_products'];
                            $products = $row['products_name'];
                            $pick_up_store = $row['store_name'];
                            $store_location = $row['store_location'];
                            $date_order_placed = $row['order_date'];
                            $status = $row['status'];

                            //set order serial number
                            $sn = 1;
                            //print the data in the table
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td>#order1 <?php echo $order_id; ?></td>
                                    <td><?php echo $no_of_products_ordered; ?></td>
                                    <td><?php echo $products; ?></td>
                                    <td><?php echo $pick_up_store." "; ?><?php echo $store_location; ?></td>
                                    <td><?php echo $date_order_placed ?></td>
                                    <td class="status-pending"><?php echo $status; ?></td>
                                    <td>
                                        <a href="#" class="btn secondary">Print</a>
                                    </td>
                                </tr>
                            
                            <?php
                        }
                    }
                    else{
                        //print message there is no order cancelled
                        ?>
                        <tr>
                            <td colspan="8" style="color:red;">There is no order cancelled</td>
                        </tr>
                        <?php
                    }
                ?>    
            </table>
        </section>
        <section class="text-center">
            <h3>Onway Orders</h3>
            <table class="tbl-100">
                <tr>
                    <th>S.N</th>
                    <th>Order Id</th>
                    <th>No.of Products</th>
                    <th>Products</th>
                    <th>Pickup Store</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Print order</th>
                </tr>
                <?php
                    //setting status of order and customer id
                    $order_status = "Onway";
                    $customer_id = $_SESSION['customer_id'];

                    //SQL query to select order id where order status is onway
                    $sql = "SELECT * FROM `tbl_orders` WHERE `status`='$order_status' AND `customer_id`='$customer_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the number of records of orders onway in the database
                    $count = mysqli_num_rows($res);

                    //check the number of records of orders onway in the database
                    if($count > 0){
                        //loop through the table to get all the records
                        while($row = mysqli_fetch_assoc($res)){
                            //set the data from the database to variables
                            $order_id = $row['order_id'];
                            $no_of_products_ordered = $row['no._of_products'];
                            $products = $row['products_name'];
                            $pick_up_store = $row['store_name'];
                            $store_location = $row['store_location'];
                            $date_order_placed = $row['order_date'];
                            $status = $row['status'];

                            //set order serial number
                            $sn = 1;
                            //print the data in the table
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td>#order1 <?php echo $order_id; ?></td>
                                    <td><?php echo $no_of_products_ordered; ?></td>
                                    <td><?php echo $products; ?></td>
                                    <td><?php echo $pick_up_store." "; ?><?php echo $store_location; ?></td>
                                    <td><?php echo $date_order_placed ?></td>
                                    <td class="status-pending"><?php echo $status; ?></td>
                                    <td>
                                        <a href="#" class="btn secondary">Print</a>
                                    </td>
                                </tr>
                            
                            <?php
                        }
                    }
                    else{
                        //print message there is no order onway
                        ?>
                        <tr>
                            <td colspan="8" style="color:#0b0be4;">There is no order onway</td>
                        </tr>
                        <?php
                    }
                ?>    
            </table>
        </section>
        <section class="text-center">
            <h3>Delivered Orders</h3>
            <table class="tbl-100">
                <tr>
                    <th>S.N</th>
                    <th>Order Id</th>
                    <th>No.of Products</th>
                    <th>Products</th>
                    <th>Pickup Store</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Print order</th>
                </tr>
                <?php
                    //setting status of order and customer id
                    $order_status = "Delivered";
                    $customer_id = $_SESSION['customer_id'];

                    //SQL query to select order id where order status is delivered
                    $sql = "SELECT * FROM `tbl_orders` WHERE `status`='$order_status' AND `customer_id`='$customer_id'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count the number of records of orders delivered in the database
                    $count = mysqli_num_rows($res);

                    //check the number of records of orders delivered in the database
                    if($count > 0){
                        //loop through the table to get all the records
                        while($row = mysqli_fetch_assoc($res)){
                            //set the data from the database to variables
                            $order_id = $row['order_id'];
                            $no_of_products_ordered = $row['no._of_products'];
                            $products = $row['products_name'];
                            $pick_up_store = $row['store_name'];
                            $store_location = $row['store_location'];
                            $date_order_placed = $row['order_date'];
                            $status = $row['status'];

                            //set order serial number
                            $sn = 1;
                            //print the data in the table
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td>#order1 <?php echo $order_id; ?></td>
                                    <td><?php echo $no_of_products_ordered; ?></td>
                                    <td><?php echo $products; ?></td>
                                    <td><?php echo $pick_up_store." "; ?><?php echo $store_location; ?></td>
                                    <td><?php echo $date_order_placed ?></td>
                                    <td class="status-pending"><?php echo $status; ?></td>
                                    <td>
                                        <a href="#" class="btn secondary">Print</a>
                                    </td>
                                </tr>
                            
                            <?php
                        }
                    }
                    else{
                        //print message there is no order delivered
                        ?>
                        <tr>
                            <td colspan="8" style="color:green;">There is no order Delivered</td>
                        </tr>
                        <?php
                    }
                ?>    
            </table>
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