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
    <title>Electro Store - Admin control panel update customer order </title>
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
</head>
<body>
    <!--menu-section starts here section-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here section-->

    <!--main-section starts here section-->
    <section class="main-section">
        <div class="wrapper">
            <div class="form-control">
                <div class="form-title">
                    <h2>Update Customer Order</h2>
                </div>
                <div class="form-content">
                    <?php
                        //check if order id is set
                        if($_GET['order_id']){
                            //set order id
                            $order_id = $_GET['order_id'];

                            //get the order from the database
                            //SQL query to to get order record from the database
                            $sql = "SELECT * FROM `tbl_orders` WHERE `order_id`='$order_id'";

                            //execute the query
                            $res = mysqli_query($conn, $sql);

                            //store the data of order record in an array
                            $row = mysqli_fetch_assoc($res);

                            //set the data on the variable names
                            $order_id = $row['order_id'];
                            $date_ordered = $row['order_date'];
                            $order_status = $row['status'];

                            //set path variable
                            //check status first
                            if($order_status == "Pending"){
                                $path = "update-pending-orders.php";
                            }
                            else if($order_status == "Onway"){
                                $path = "update-onway-orders.php";
                            }
                        }
                        else{
                            //redirect to manage orders page
                            echo "<script>window.location='manage-orders.php'</script>";
                        }
                    ?>
                    <form action="" method="POST">
                        <table>
                            <tr>
                                <td>Order Id:</td>
                                <td><?php echo $order_id; ?></td>
                            </tr>
                            <tr>
                                <td>Order Date:</td>
                                <td><?php echo $date_ordered; ?></td>
                            </tr>
                            <tr>
                                <td>Order Status:</td>
                                <td><?php echo $order_status; ?></td>
                            </tr>
                            <tr> 
                                <td>Update Order Status:</td> 
                                <td>
                                    <?php
                                        //set select menu for update pending orders and update onway orders
                                        //check the status of order first
                                        if($order_status == "Pending"){
                                            ?>
                                            <select name="new_order_status">                        
                                                <option <?php $pending = "Pending"; if($pending == $order_status){ echo "selected"; }?> value="<?php echo $pending; ?>"><?php echo $pending; ?></option>
                                                <option <?php $onway = "Onway"; if($onway == $order_status){ echo "selected"; }?> value="<?php echo $onway; ?>"><?php echo $onway; ?></option>
                                                <option <?php $cancelled = "Cancelled"; if($cancelled == $order_status){ echo "selected"; }?> value="<?php echo $cancelled; ?>"><?php echo $cancelled; ?></option>
                                            </select>
                                            <?php
                                        }
                                        else if($order_status == "Onway"){
                                            ?>
                                            <select name="new_order_status">                        
                                                <option <?php $onway = "Onway"; if($onway == $order_status){ echo "selected"; }?> value="<?php echo $onway; ?>"><?php echo $onway; ?></option>
                                                <option <?php $cancelled = "Cancelled"; if($cancelled == $order_status){ echo "selected"; }?> value="<?php echo $cancelled; ?>"><?php echo $cancelled; ?></option>
                                                <option <?php $delivered = "Delivered"; if($delivered == $order_status){ echo "selected"; }?> value="<?php echo $delivered; ?>"><?php echo $delivered; ?></option>
                                            </select>
                                            <?php
                                        }
                                    ?>
                                    
                                </td>
                                  
                            </tr>
                            <tr>
                                <td><input type="submit" name="update_order" value="Update Order" class="btn secondary"></td>
                            </tr>    
                        </table>
                    </form>
                    <?php
                        //check if update order button is clicked
                        if(isset($_POST['update_order'])){
                            //collect data from the form select field
                            $new_order_status = $_POST['new_order_status'];

                            //SQL to update the order
                            $sql2 = "UPDATE `tbl_orders` 
                            SET `status`='$new_order_status'
                            WHERE `order_id`='$order_id'";

                            //execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            //check if query executed successfully
                            if($res2 == true){
                                //set update session variable
                                $_SESSION['update_order'] = "<div class='success'>Order Update Successfully!</div>";
                                echo "<script>window.location='$path'</script>";
                            }
                        }
                    ?>
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