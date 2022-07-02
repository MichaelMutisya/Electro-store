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
    <title>Electro Store - Admin control panel manage stores </title>
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
    <script defer src="../js/adminapp.js"></script>
</head>
<body>
    <!--menu-section starts here section-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here section-->

    <!--main-section starts here section-->
    <section class="main-section">
        <div class="wrapper">
            <div class="manage-tbl">
                <a href="<?php echo SITEURL; ?>admin/add-store.php" class="btn primary">Add Store</a>
                <br><br>
                <?php
                    //print add store session variables
                    if(isset($_SESSION['add-store'])){
                        echo $_SESSION['add-store'];
                        unset($_SESSION['add-store']);
                    }
                    //print update store session variables
                    if(isset($_SESSION['update-store'])){
                        echo $_SESSION['update-store'];
                        unset($_SESSION['update-store']);
                    }
                    //print delete store session variables
                    if(isset($_SESSION['delete-store'])){
                        echo $_SESSION['delete-store'];
                        unset($_SESSION['delete-store']);
                    }
                ?>
                <br>
                <table class="tbl-100 text-center">
                    <tr>
                        <th>S.No.</th>
                        <th>Store Name</th>
                        <th>Location</th>
                        <th>Operations</th>
                    </tr>
                    <?php 
            
                        //SQL to read data from the database
                        $sql = "SELECT * FROM `tbl_stores` WHERE 1";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //count row to check if there is any data in the database table
                        $count = mysqli_num_rows($res);

                        //initializing serial number for store 
                        $sn = 1;

                        //test if the count has rows or not
                        if($count > 0){
                            //there is data in the table
                            //loop in the rows to get all data
                            while($row = mysqli_fetch_assoc($res)){
                                $store_id = $row['store_id'];
                                $store_name = $row['store_name'];
                                $store_location = $row['store_location'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $store_name; ?></td>
                                    <td><?php echo $store_location; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-store.php?store_id=<?php echo $store_id; ?>" class="btn secondary">Update</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-store.php?store_id=<?php echo $store_id; ?>" class="btn danger">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else{
                            //there is no data in the table
                            ?>
                            <td colspan="5">
                                <?php echo "<div class='error text-center'>Store table is empty!</div>"; ?>
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