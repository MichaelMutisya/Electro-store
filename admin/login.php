<?php
    //include constants file to connect to the
    include('../config/constants.php');
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
    <title>Electro Store - Admin Control Panel Login </title>

    <!-- META AUTHOR -->
    <meta name="author" content="Michael Mutisya">

    <!-- FAVICON-->
    <link  rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CASCADING STYLE SHEET -->
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body class="login-register">
    <section id="login" class="login">
        <div class="logo" style="font-size: 50px;">
            <h4>ELECTRO <span>STORE </span><i class="fa-solid fa-sd-card"></i></i></h4>
        </div>
        <div class="login-form">
            <form action="" method="POST">
                <?php
                    //print error messages to the admin
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "usernamedontexists"){
                            echo "<p class='error text-center'>Username, email or phone number does not exist!</p>";
                        }
                        else if ($_GET['error'] == "wrongpassword"){
                            echo "<p class='error text-center'>Wrong password!</p>";
                        }
                    }
                    //print not logged in session variables 
                    if(isset($_SESSION['not-logged-in'])){
                        echo $_SESSION['not-logged-in'];
                        unset($_SESSION['not-logged-in']);
                    }
                    //print delete admin session variables
                    if(isset($_SESSION['delete-admin'])){
                        echo $_SESSION['delete-admin'];
                        unset($_SESSION['delete-admin']);
                    }
                ?>
                <br><br>
                <h3 class="text-center">Admin Control Panel - Login</h3>
                <br><br>
                <div class="form">
                    <div class="form-controller">
                        <input type="text" name="username" class="input-text" placeholder="Enter username, email or phone number" autocomplete="off" autofocus required>
                        <i class="fa fa-user solid"></i>  
                    </div>
                    <div class="form-controller">
                        <input type="password" name="password" class="input-text" placeholder="Enter Password" autocomplete="off" required>
                        <i class="fa fa-unlock solid"></i>  
                    </div>
                    <p class="text-center">&copy; <?php date('Y'); ?> All rights reserved - Created By <a href="#">Michael Mutisya</a></p>
                    <button type="submit" class="btn primary text-center" name="login">LOGIN</button>
                </div>
            </form>
            <?php
                //check if login button is clicked
                if(isset($_POST['login'])){
                    //collect login data from the form
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                    //test the data inserted on the form using form error handler script
                    include('../config/form-error-handler.php');
                    //check if the form inputs are empty
                    if(empty_input_login($username, $password) !== false){
                        header('location:'.SITEURL.'admin/login.php?error=emptyinput');
                        exit();
                    }
                    //login the user to the admin panel
                    login_admin($conn, $username, $password);
                }

            ?>
        </div>
    </section>
</body>
</html>