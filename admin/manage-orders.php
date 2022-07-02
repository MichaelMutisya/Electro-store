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
    <title>Electro Store - Admin control panel manage orders </title>
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
    <script defer src="js/adminapp.js"></script>
</head>
<body>
    <!--menu-section starts here section-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here section-->

    <!--main-section starts here section-->
    <section class="main-section">
        <div class="wrapper">
            <div class="update-orders">
                    <div class="update-card">
                        <a href="<?php echo SITEURL; ?>admin/update-pending-orders.php" class="btn secondary">Update Pending Orders</a>
                    </div>
                    <div class="update-card">
                        <a href="<?php echo SITEURL; ?>admin/update-onway-orders.php" class="btn secondary">Update Onway Orders</a>
                    </div>
            </div>
            <div class="manage-tbl-o">
                <table class="tbl-100 text-center">
                    <tr>
                        <th>S.No.</th>
                        <th>Order Id</th>
                        <th>Customer email</th>
                        <th>Customer phone number</th>
                        <th>Number of products ordered</th>
                        <th>Products ordered</th>
                        <th>Order date</th>
                        <th>Pickup Station</th>
                        <th>Total amount</th>
                        <th>Status</th>
                    </tr>
                    <?php 
            
                        //SQL to read data from the database
                        $sql = "SELECT * FROM `tbl_orders` WHERE `status`='Pending' OR `status`='Onway' OR `status`='Cancelled' OR `status`='Delivered'";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //count row to check if there is any data in the database table
                        $count = mysqli_num_rows($res);

                        //initializing serial number for order 
                        $sn = 1;

                        //test if the count has rows or not
                        if($count > 0){
                            //there is data in the table
                            //loop in the rows to get all data
                            while($row = mysqli_fetch_assoc($res)){
                                $order_id = $row['order_id'];
                                $customer_email = $row['customer_email'];
                                $customer_phone_number= $row['customer_phone_number'];
                                $number_of_products_ordered = $row['no._of_products'];
                                $products_ordered = $row['products_name'];
                                $order_date = $row['order_date'];
                                $pickup_station = $row['pickup_station'];
                                $total_amount = $row['total_amount'];
                                $status = $row['status'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo "Order#". $order_id; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_phone_number; ?></td>
                                    <td><?php echo $number_of_products_ordered; ?></td>
                                    <td><?php echo $products_ordered; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $pickup_station; ?></td>
                                    <td><?php echo "Ksh.".$total_amount; ?></td>
                                    <?php
                                        if($status == "Pending"){
                                            ?>
                                                <td class="status-pending"><?php echo $status; ?></td>
                                            <?php
                                        }else if($status == "Cancelled"){
                                            ?>
                                                <td class="status-cancelled"><?php echo $status; ?></td>
                                            <?php
                                        }else if($status == "Onway"){
                                            ?>
                                                <td class="status-onway"><?php echo $status; ?></td>
                                            <?php
                                        }else if($status == "Delivered"){
                                            ?>
                                                <td class="status-delivered"><?php echo $status; ?></td>
                                            <?php
                                        }
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            //there is no data in the table
                            ?>
                            <td colspan="10">
                                <?php echo "<div class='error text-center'>Order table is empty!</div>"; ?>
                            </td>
                            <?php
                        } 
                    ?>
                </table>
            </div>
        </div>
    </section>
    <!--main-section ends here section-->
    
    <!--footer-section starts here section-->
    <?php include('partials/footer.php'); ?>
    <!--footer-section ends here section-->
</body>
</html>