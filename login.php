<?php include('config/constants.php'); ?>
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
    <title>Electro Store - Customer register or login to Electro store to shop </title>

    <!-- META AUTHOR -->
    <meta name="author" content="Michael Mutisya">

    <!-- FAVICON-->
    <link  rel="shortcut icon" type="image/ico" href="images/favicon.ico">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CASCADING STYLE SHEET -->
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body class="login-register">
    <section id="login" class="login">
        <div class="logo" style="font-size: 50px;">
            <h4>ELECTRO <span>STORE </span><i class="fa-solid fa-sd-card"></i></i></h4>
        </div>
        <div class="login-form">
            <form action="" method="POST">
                <?php
                    //print  error session variables 
                    if(isset($_SESSION['error'])){
                        //check if error get variable is set
                        if(isset($_GET['error'])){
                            //check if useremail or phone number exist
                            if($_GET['error'] == "useremailphonenumberexist"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            //check if the email is valid
                            else if($_GET['error'] == "wrongpassword"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            //check if the inputs are filled
                            else if($_GET['error'] == "emptyinputl"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                        }
                    }
                    //print not logged in session variables 
                    if(isset($_SESSION['not-logged-in'])){
                        echo $_SESSION['not-logged-in'];
                        unset($_SESSION['not-logged-in']);
                    }
                    //print add-customer in session variables 
                    if(isset($_SESSION['add-customer'])){
                        //check registered get variable is set
                        if(isset($_GET['registered'])){
                            //check if registered
                            if($_GET['registered'] == "success"){
                                echo $_SESSION['add-customer'];
                                unset($_SESSION['add-customer']);
                            }
                        }
                    }
                ?>
                <br><br>
                <h2 class="text-center">Login</h2>
                <div class="form">
                    <div class="form-controller">
                        <input type="text" name="username" class="input-text" placeholder="Enter Phone Number or Email" autofocus>
                        <i class="fa fa-user solid"></i>  
                    </div>
                    <div class="form-controller">
                        <input type="password" name="password" class="input-text" placeholder="Enter Password">
                        <i class="fa fa-unlock solid"></i>  
                    </div>
                    <a href="#">Forget Password?</a>
                    <p>Don't have an account?-<a href="#register">Create account</a></p>
                    <button type="submit" class="btn primary text-center" name="login">LOGIN</button>
                </div>
            </form>
            <?php
                //check if login global variable is set
                if(isset($_POST['login'])){
                    //collect login data from the form
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                    //test the data inserted on the form using form error handler script
                    include('config/form-error-handler.php');
                    
                    //check if the form inputs are empty
                    if(empty_input_login_customer($username, $password) !== false){
                        //set error session variable
                        $_SESSION['error'] = "<div class='error text-center'>Fill all login inputs!</div>";
                        //redirect the the customer to login page
                        echo "<script>window.location='login.php?error=emptyinputl#login'</script>";
                        exit();
                    }
                    //login the customer to be able to purchase products
                    login_customer($conn, $username, $password); 
                }
            ?>
        </div>
    </section>
    <section id="register" class="register">
        <div class="logo" style="font-size: 50px;">
            <h4>ELECTRO <span>STORE </span><i class="fa-solid fa-sd-card"></i></i></h4>
        </div>
        <div class="register-form">
            <form action="" method="POST">
                <?php
                    //print  error session variables 
                    if(isset($_SESSION['error'])){
                        if(isset($_GET['error'])){
                            //check if inputs are empty
                            if($_GET['error'] == "emptyinput"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            //check if the email is valid
                            else if($_GET['error'] == "invalidemail"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            //check if password match
                            else if($_GET['error'] == "passworddontmatch"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            //check if user email or phone number exist
                            else if($_GET['error'] == "useremailphonenumberexistr"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                            //check if stmt failed to initialize
                            else if($_GET['error'] == "stmtfailed"){
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            }
                        }
                    }
                ?>
                <br><br>
                <h2 class="text-center">Register</h2>
                <div class="form">
                    <div class="form-controller">
                        <input type="text" name="customer_name" class="input-text" placeholder="Enter Your Fullname" autofocus required>
                        <i class="fa fa-user solid"></i>  
                    </div>
                    <div class="form-controller">
                        <input type="tel" name="phone_number" class="input-text" placeholder="Enter Your Phone Number" required>
                        <i class="fa-solid fa-phone solid"></i> 
                    </div>
                    <div class="form-controller">
                        <input type="email" name="email" class="input-text" placeholder="Enter Your email" required>
                        <i class="fa-solid fa-envelope solid"></i> 
                    </div>
                    <div class="form-controller">
                        <input type="password" name="password" class="input-text" placeholder="Enter Your Password" required>
                        <i class="fa fa-lock solid"></i>  
                    </div>
                    <div class="form-controller">
                        <input type="password" name="confirm_password" class="input-text" placeholder="Confirm Your Password" required>
                        <i class="fa-solid fa-lock solid"></i>
                    </div>
                    <p>Have an account?-<a href="#login">Login</a></p>
                    <button type="submit" class="btn primary" name="register_customer">REGISTER</button>
                </div>
            </form>
            <?php
                if(isset($_POST['register_customer'])){
                    //collect the data from the form
                    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
                    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                    //test the data inserted on the form using form error handler script
                    include('config/form-error-handler.php');

                    //check if all the form input are filled in
                    if(empty_input_signup_customer($customer_name, $email, $phone_number, $password, $confirm_password) !== false){
                        //set error session variable
                        $_SESSION['error'] = "<div class='error text-center'>Fill all the inputs!</div>";
                        //redirect the the customer to register page
                        echo "<script>window.location='login.php?error=emptyinput#register'</script>";
                        exit();
                    }
                    
                    //check if the email is invalid
                    if(valid_email($email) !== false){
                        //set error session variable
                        $_SESSION['error'] = "<div class='error text-center'>Choose a proper email!</div>";
                        //redirect the the customer to register page
                        echo "<script>window.location='login.php?error=invalidemail#register'</script>";
                        exit();
                    }
                    //check if password match
                    if(password_match($password, $confirm_password) !== false){
                        //set error session variable
                        $_SESSION['error'] = "<div class='error text-center'>Passwords doesn't match!</div>";
                        //redirect the the customer to register page
                        echo "<script>window.location='login.php?error=passworddontmatch#register'</script>";
                        exit();
                    }

                    //check if email or phone number is already taken
                    if(email_exists($conn, $phone_number, $email) !== false){
                        //set error session variable
                        $_SESSION['error'] = "<div class='error text-center'>Email or phone number already taken!</div>";
                        //redirect the the customer to register page
                        echo "<script>window.location='login.php?error=useremailphonenumberexistr#register'</script>";
                        exit();
                    }

                    //create the new customer to the system
                    create_customer($conn, $customer_name, $email, $phone_number, $password);
                }
            ?>
        </div>
    </section>
</body>
</html>