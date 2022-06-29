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
    <title>Electro Store - Admin control panel add administrator </title>
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
                    <h2>Add Administrator</h2>
                </div>
                <div class="form-content">
                    <?php
                        ob_start();
                        //check if error global variable is set
                        if(isset($_GET['error'])){
                            if($_GET['error'] == "emptyinput"){
                                echo "<div class='error text-center'>Fill in all form inputs!</div>";
                            }
                            else if ($_GET['error'] == "invalidusername"){
                                echo "<div class='error text-center'>Choose a proper username!</div>";
                            }
                            else if ($_GET['error'] == "invalidemail"){
                                echo "<div class='error text-center'>Choose a proper email!</div>";
                            }
                            else if ($_GET['error'] == "passwordsdontmatch"){
                                echo "<div class='error text-center'>Passwords doesn't match!</div>";
                            }
                            else if ($_GET['error'] == "stmtfailed"){
                                echo "<div class='error text-center'>Something went wrong, try again!</div>";
                            }
                            else if ($_GET['error'] == "usernametaken"){
                                echo "<div class='error text-center'>Username, email or phone number already taken!</div>";
                            }
                        }
                    ?>
                    <form action="" method="POST">
                        <table>
                            <tr> 
                                <td>Enter Your Name:</td> 
                                <td><input type="text" name="admin_name" required autofocus placeholder="Enter your name"></td>   
                            </tr>
                            <tr>
                                <td>Enter Your Username:</td>
                                <td><input type="text" name="username" required placeholder="Enter your username"></td>
                            </tr>
                            <tr>
                                <td>Enter Your Email:</td>
                                <td><input type="email" name="email" required placeholder="Enter your email address"></td>
                            </tr>
                            <tr>
                                <td>Enter Your Number:</td>
                                <td><input type="tel" name="phone_number" required placeholder="Enter your phone number"></td>
                            </tr>
                            <tr>
                                <td>Enter Your Password:</td>
                                <td><input type="password" name="password" required placeholder="Enter your password"></td>
                            </tr>
                            <tr>
                                <td>Confirm Your Password:</td>
                                <td><input type="password" name="confirm_password" required placeholder="Confirm your password"></td>
                            </tr>  
                            <tr>
                                <td><input type="submit" name="add_admin" value="Add Admin" class="btn primary"></td>
                            </tr> 
                        </table>
                    </form>
                    <?php
                        //check if add_admin button is clicked
                        if(isset($_POST['add_admin'])){
                            //collect the data from the form
                            $admin_name = mysqli_real_escape_string($conn, $_POST['admin_name']);
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
                            $password = mysqli_real_escape_string($conn, $_POST['password']);
                            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                            //test the data inserted on the form using form error handler script
                            include('../config/form-error-handler.php');

                            //check if all the form input are filled in
                            if(empty_input_signup($admin_name, $username, $email, $phone_number, $password, $confirm_password) !== false){
                                header('location:'.SITEURL.'admin/add-admin.php?error=emptyinput');
                                ob_end_flush();
                                exit();
                            }

                            //check if the username is invalid
                            if(valid_username($username) !== false){
                                header('location:'.SITEURL.'admin/add-admin.php?error=invalidusername');
                                ob_end_flush();
                                exit();
                            }
                            
                            //check if the email is invalid
                            if(valid_email($email) !== false){
                                header('location:'.SITEURL.'admin/add-admin.php?error=invalidemail');
                                ob_end_flush();
                                exit();
                            }
                            //check if password match
                            if(password_match($password, $confirm_password) !== false){
                                header('location:'.SITEURL.'admin/add-admin.php?error=passwordsdontmatch');
                                ob_end_flush();
                                exit();
                            }

                            //check if username is already taken
                            if(username_exists($conn, $username, $email , $phone_number) !== false){
                                header('location:'.SITEURL.'admin/add-admin.php?error=usernametaken');
                                ob_end_flush();
                                exit();
                            }

                            //create the new admin to the system
                            create_admin($conn,$admin_name, $username, $email, $phone_number, $password);
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