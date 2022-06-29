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
    <title>Electro Store - Admin control panel update administrator </title>
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
                    <h2>Update Administrator</h2>
                </div>
                <div class="form-content">
                    <?php
                        ob_start();
                        //check if admin id is set
                        if(isset($_GET['admin_id'])){
                            //get the id of the selected admin
                            $admin_id = $_GET['admin_id'];

                            //SQL query to get the details of the admin from the database
                            $sql = "SELECT * FROM tbl_admin WHERE admin_id=$admin_id";

                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //Test if the query is executed
                            if($res == true){
                                //check whether data is available or not
                                $count = mysqli_num_rows($res);
                                //test whether customer data with id given is available or not
                                if($count == 1){
                                //get the data
                                $row = mysqli_fetch_assoc($res);

                                $admin_name= $row['name'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $phone_number = $row['phone_number'];
                                $password = $row['password'];
                                }
                                else{
                                    //redirect to the manage-custmer page
                                    header('location:'.SITEURL.'admin/manage-admins.php');
                                    ob_end_flush();
                                }
                            }
                        }
                    ?>
                    <form action="" method="POST">
                        <?php
                            //print error variables
                            if(isset($_GET['error'])){
                                echo $_GET['error'];
                                unset($_GET['error']);
                            }
                            //print update admin session variables
                            if(isset($_SESSION['update-admin'])){
                                echo $_SESSION['update-admin'];
                                unset($_SESSION['update-admin']);
                            }
                        ?>
                        <table>
                            <tr> 
                                <td>Update your Name:</td> 
                                <td><input type="text" name="admin_name" required autofocus value="<?php echo $admin_name; ?>"></td>   
                            </tr>
                            <tr> 
                                <td>Update your Username:</td> 
                                <td><input type="text" name="username" required value="<?php echo $username; ?>"></td>   
                            </tr>
                            <tr>
                                <td>Update your Email:</td>
                                <td><input type="email" name="email" required value="<?php echo $email; ?>"></td>
                            </tr>
                            <tr>
                                <td>Update your Number:</td>
                                <td><input type="tel" name="phone_number" required value="<?php echo $phone_number; ?>"></td>
                            </tr>
                            <tr>
                                <td>Enter your Current Password:</td>
                                <td><input type="password" name="current_password" required ></td>
                            </tr>
                            <tr>
                                <td>Enter your new Password:</td>
                                <td><input type="password" name="new_password" required></td>
                            </tr> 
                            <tr>
                                <td>Confirm your new Password:</td>
                                <td><input type="password" name="confirm_new_password" required></td>
                            </tr> 
                            <tr>
                                <td><input type="submit" name="update_admin" value="Update Admin" class="btn secondary"></td>
                            </tr> 
                            
                        </table>
                    </form>
                    <?php 
                        //check if update admin is clicked
                        if(isset($_POST['update_admin']))
                        {
                            //collect data from the form
                            $admin_name= mysqli_real_escape_string($conn, $_POST['admin_name']);
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
                            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);

                            
                            //include form error handle to sanitize form data inputs
                            include('../config/form-error-handler.php');
                            //check if all the form input are filled in
                            if(empty_input_update($admin_name, $username, $email, $phone_number, $password, $new_password, $confirm_new_password) !== false){
                                $_SESSION['update-admin'] = "<div class='error text-center'>Fill in the inputs!</div>";
                                header('location:'.SITEURL.'admin/update-admin.php?admin_id='.$admin_id);
                                ob_end_flush();
                                exit();
                            }

                            //check if old password mathch new password
                            if(old_password_match($password, $new_password) !== false){
                                $_SESSION['update-admin'] = "<div class='error text-center'>Incorrect old password!</div>";
                                header('location:'.SITEURL.'admin/update-admin.php?admin_id='.$admin_id);
                                ob_end_flush();
                                exit();
                            }
                            //check if the username is invalid
                            if(valid_username($username) !== false){
                                $_SESSION['update-admin'] = "<div class='error text-center'>Invalid username!</div>";
                                header('location:'.SITEURL.'admin/update-admin.php?admin_id='.$admin_id);
                                ob_end_flush();
                                exit();
                            }
                            
                            //check if the email is invalid
                            if(valid_email($email) !== false){
                                $_SESSION['update-admin'] = "<div class='error text-center'>Invalid email!</div>";
                                header('location:'.SITEURL.'admin/update-admin.php?admin_id='.$admin_id);
                                ob_end_flush();
                                exit();
                            }
                            //check if password match
                            if(password_match($password, $confirm_password) !== false){
                                $_SESSION['update-admin'] = "<div class='error text-center'>Password don't match!</div>";
                                header('location:'.SITEURL.'admin/update-admin.php?admin_id='.$admin_id);
                                ob_end_flush();
                                exit();
                            }

                            //check if username is already taken
                            if(username_exists($conn, $username, $email , $phone_number) !== false){
                                $_SESSION['update-admin'] = "<div class='error text-center'>Username is already taken!</div>";
                                header('location:'.SITEURL.'admin/update-admin.php?admin_id='.$admin_id);
                                ob_end_flush();
                                exit();
                            }
                            //update the admin
                            update_admin($conn, $admin_name, $username, $email, $phone_number, $new_password);

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