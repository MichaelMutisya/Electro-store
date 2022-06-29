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
    <title>Electro Store - Admin control panel update store </title>
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
                    <h2>Update Store</h2>
                </div>
                <div class="form-content">
                    <?php
                        ob_start();
                        //check if store id is set
                        if(isset($_GET['store_id'])){
                            //get the id of the selected store
                            $store_id = $_GET['store_id'];

                            //SQL query to get the details of the store from the database
                            $sql = "SELECT * FROM tbl_stores WHERE store_id=$store_id";

                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //Test if the query is executed
                            if($res == true){
                                //check whether data is available or not
                                $count = mysqli_num_rows($res);
                                //test whether store data with id given is available or not
                                if($count == 1){
                                //get the data
                                $row = mysqli_fetch_assoc($res);

                                $store_name = $row['store_name'];
                                $store_location = $row['store_location'];
                                }
                                else{
                                    //redirect to the manage store page
                                    header('location:'.SITEURL.'admin/manage-stores.php');
                                    ob_end_flush();
                                }
                            }
                        }
                        else{
                            //redirect to the manage store page
                            header('location:'.SITEURL.'admin/manage-stores.php');
                        }
                    ?>
                    <form action="" method="POST">
                        <table>
                            <tr> 
                                <td>Update Store Name:</td> 
                                <td><input type="text" name="store_name" required autofocus value="<?php echo $store_name; ?>"></td>   
                            </tr>
                            <tr>
                                <td>Update Store Location:</td>
                                <td><input type="text" name="store_location" required value="<?php echo $store_location; ?>"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="update_store" value="Update Store" class="btn secondary"></td>
                            </tr>    
                        </table>
                    </form>
                    <?php
                        //check if update store button is clicked
                        if(isset($_POST['update_store'])){
                            //Collect all the values from the form
                            $store_name= mysqli_real_escape_string($conn, $_POST['store_name']);
                            $store_location = mysqli_real_escape_string($conn, $_POST['store_location']);
                            
                            //Update the database   
                            $sql2 = "UPDATE `tbl_stores` 
                            SET `store_id`='',
                            `store_name`='$store_name',
                            `store_location`='$store_location' 
                            WHERE `store_id`=$store_id";
                            //4.Execute the query
                            $res2 = mysqli_query($conn, $sql2);
                            //5.Redirect to manage store page
                            //check if the query is executed
                            if($res2 == true){
                                //update store then redirect to manage stores page
                                $_SESSION['update-store'] = "<div class='success'>Store updated successfully!</div>";
                                header('location:'.SITEURL.'admin/manage-stores.php');
                            }
                            else{
                                //redirect to manage stores page with a failed error message
                                $_SESSION['update-store'] = "<div class='error'>Failed to update store!</div>";
                                header('location:'.SITEURL.'admin/manage-stores.php');
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