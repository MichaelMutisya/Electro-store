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
    <title>Electro Store - Admin control panel manage customers </title>
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
            <div class="manage-tbl">
                <br><br>
                <?php
                    //print delete customer session variables
                    if(isset($_SESSION['delete-customer'])){
                        echo $_SESSION['delete-customer'];
                        unset($_SESSION['delete-customer']);
                    }
                ?>
                <br>  
                <table class="tbl-100 text-center">
                    <tr>
                        <th>S.No.</th>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>Operations</th>
                    </tr>
                    <?php 
            
                        //SQL to read data from the database
                        $sql = "SELECT * FROM `tbl_customers` WHERE 1";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //count row to check if there is any data in the database table
                        $count = mysqli_num_rows($res);

                        //initializing serial number for customer 
                        $sn = 1;

                        //test if the count has rows or not
                        if($count > 0){
                            //there is data in the table
                            //loop in the rows to get all data
                            while($row = mysqli_fetch_assoc($res)){
                                $customer_id = $row['customer_id'];
                                $fullname = $row['name'];
                                $email = $row['email'];
                                $phone_number = $row['phone_number'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td><?php echo $phone_number; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/delete-customer.php?customer_id=<?php echo $customer_id; ?>" class="btn danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            //there is no data in the table
                            ?>
                            <td colspan="5">
                                <?php echo "<div class='error text-center'>Customer table is empty!</div>"; ?>
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