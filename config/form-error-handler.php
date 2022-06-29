<?php
    //ADMIN SIGNUP AND LOGIN
    //1.SIGNUP
    //Sign-up form error handlers functions for admin
    //handle empty inputs
    function empty_input_signup($admin_name, $username, $email, $phone_number, $password, $confirm_password){
        if(empty($admin_name) || empty($username) || empty($email) || empty($phone_number) || empty($password) || empty($confirm_password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //handle invalid username
    function valid_username($username){
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //handle invalid email
    function valid_email($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //handle when password don't match
    function password_match($password, $confirm_password){
        if($password !== $confirm_password){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //handle if the username is taken
    function username_exists($conn, $username, $email, $phone_number){
        $sql = "SELECT * FROM  `tbl_admin` WHERE `username` = ? OR `email` = ? OR `phone_number` = ?";
        $stmt = mysqli_stmt_init($conn);
        //check if stmt prepare executed successfully
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location'.SITEURL.'admin/add-admin.php?error=stmtfailed');
            exit();
        }
        //bind the user parameter with stmt arguments
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $phone_number);
        //execute stmt
        mysqli_stmt_execute($stmt);

        $res_data = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($res_data)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
    //create the admin
    function create_admin($conn, $admin_name, $username, $email, $phone_number, $password){
        $sql = "INSERT INTO `tbl_admin` (`name`, `username`, `email`, `phone_number`, `password`)
        VALUES (?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location'.SITEURL.'admin/add-admin.php?error=stmtfailed');
            exit();
        }
        //hash the password to secure it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $admin_name, $username, $email, $phone_number, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['add-admin'] = "<div class='success'>Admin added successfully!</div>";
        header('location:'.SITEURL.'admin/manage-admins.php');
        exit();
    }
    //update admin
    function update_admin($conn, $admin_name, $username, $email, $phone_number, $new_password){
        $sql = "UPDATE `tbl_admin` 
        SET `admin_id`='',`name`='?',`username`='?',`email`='?',`phone_number`='?',`password`='?' WHERE 1";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location'.SITEURL.'admin/add-admin.php?error=stmtfailed');
            exit();
        }
        //hash the password to secure it in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $admin_name, $username, $email, $phone_number, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['add-admin'] = "<div class='success'>Admin updated successfully!</div>";
        header('location:'.SITEURL.'admin/manage-admins?');
        exit();
    }
    //handle empty inputs
    function empty_input_update($admin_name, $username, $email, $phone_number, $password, $new_password, $confirm_new_password){
        if(empty($admin_name) || empty($username) || empty($email) || empty($phone_number) || empty($password) || empty($new_password) || empty($confirm_new_password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //handle old password match
    function old_password_match($password, $new_password){
        if($password !== $new_password){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    //2.LOGIN
    //Login form error handlers functions for admin
    //handle empty inputs
    function empty_input_login($username, $password){
        if(empty($username) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    //login the admin to the admin panel
    function login_admin($conn, $username, $password){
        //check is the username is already taken
        $username_exists = username_exists($conn, $username, $username, $username);

        //test if the username exists
        if($username_exists === false){
            header('location:'.SITEURL.'admin/login.php?error=usernamedontexists');
            exit();
        }

        //check if the password from the login form match the one in the database
        //get the hashed password from the database
        $password_hashed = $username_exists['password'];
        //match the passwords
        $check_password = password_verify($password, $password_hashed);

        //check if the passwords match
        if($check_password === false){
            header('location:'.SITEURL.'admin/login.php?error=wrongpassword');
            exit();
        }
        else if ($check_password === true){
            $_SESSION['admin_id'] = $username_exists['admin_id'];
            $_SESSION['user'] = $username_exists['name'];
            header('location:'.SITEURL.'admin/index.php');
            exit();
        }
    }


    //CUSTOMER SIGNUP AND LOGIN
    //1.SIGNUP
    //Sign-up form error handlers functions for customer
    //handle empty inputs
    function empty_input_signup_customer($customer_name, $phone_number, $email, $password, $confirm_password){
        if(empty($customer_name) || empty($phone_number) || empty($email) || empty($password) || empty($confirm_password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //handle username if already taken
    function email_exists($conn, $phone_number, $email){
        $sql = "SELECT * FROM  `tbl_customers` WHERE `phone_number` = ? OR `email` = ?";
        $stmt = mysqli_stmt_init($conn);
        
       
        //check if stmt prepare executed
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "<div class='error text-center'>Something went wrong on our side. We gonna fix it soon. We apologize for the inconvinience. Try again later!</div>";
            echo "<script>window.location='login.php?error=stmtfailed#register'</script>";
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $phone_number, $email);
        mysqli_stmt_execute($stmt);
        

        $res_data = mysqli_stmt_get_result($stmt);
        
        //check is record is collected from the database
        if($row = mysqli_fetch_assoc($res_data)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
    //create the customer
    function create_customer($conn, $customer_name, $email, $phone_number, $password){
        $sql = "INSERT INTO `tbl_customers`(`name`, `email`, `phone_number`, `password`)
        VALUES (?,?,?,?)";

        //initializing stmt varible
        $stmt = mysqli_stmt_init($conn);
        
        //check if stmt prepared successfully
        if(!mysqli_stmt_prepare($stmt, $sql)){
            $_SESSION['error'] = "<div class='error text-center'>Something went wrong on our side. We gonna fix it soon. We apologize for the inconvinience. Try again later!</div>";
            echo "<script>window.location='login.php?error=stmtfailed#register'</script>";
            exit();
        }
        //hash the password to secure it in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $customer_name, $email, $phone_number, $hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['add-customer'] = "<div class='success text-center'>Registered successfully! Login to shop on Elecro store.</div>";
        echo "<script>window.location='login.php?registered=success#login'</script>";
        exit();
    }

    //2.LOGIN
    //Login form error handlers functions for customer
    //handle empty inputs
    function empty_input_login_customer($username, $password){
        if(empty($username) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
    //login the admin to the admin panel
    function login_customer($conn, $username, $password){
        //check is the username is already taken
        $email_exists = email_exists($conn, $username, $username);

        //test if the username exists
        if($email_exists === false){
            //set error session variable
            $_SESSION['error'] = "<div class='error text-center'>Email or phonenumber don't exist!</div>";
            //redirect the the customer to login page
            echo "<script>window.location='login.php?error=useremailphonenumberdontexist#login'</script>";
            exit();
        }

        //check if the password from the login form match the one in the database
        //get the hashed password from the database
        $password_hashed = $email_exists['password'];
        //match the passwords
        $check_password = password_verify($password, $password_hashed);

        //check if the passwords match
        if($check_password === false){
            //set error session variable
            $_SESSION['error'] = "<div class='error text-center'>Wrong Password!</div>";
            //redirect the the customer to login page
            echo "<script>window.location='login.php?error=wrongpassword#login'</script>";
            exit();
        }
        else if ($check_password === true){
            $_SESSION['customer_id'] = $email_exists['customer_id'];
            $_SESSION['customer_user'] = $email_exists['name'];
            echo "<script>window.location='index.php'</script>";
            exit();
        }
    }

    //handle email of subscription if already taken
    function subscribe_email_exist($conn, $email){
        $sql = "SELECT * FROM `tbl_subscription` WHERE `customer_email` = ?";
        $stmt = mysqli_stmt_init($conn);

        //check if stmt prepare executed
        if(!mysqli_stmt_prepare($stmt, $sql)){
            //set an error session variable
            $_SESSION['error'] = "<div class='error text-center'>Something went wrong. Try again later!</div>";
            //redirect the user to the home page on the subscription form
            echo "<script>window.location='index.php?error=stmtfailed#footer'</script>";
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        

        $res_data = mysqli_stmt_get_result($stmt);
        
        //check is record is collected from the database
        if($row = mysqli_fetch_assoc($res_data)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }

    //subcribe to electro store news
    function subscription_registeration($conn, $name, $email){
       $sql = "INSERT INTO `tbl_subscription`(`customer_name`, `customer_email`)
        VALUES (?,?)";

        $stmt = mysqli_stmt_init($conn);
        $mike = mysqli_stmt_prepare($stmt, $sql);
        
        //check if stmt prepare executed successfully
        if(!$mike){
            //set an error session variable
            $_SESSION['error'] = "<div class='error text-center'>Something went wrong. Try again later!</div>";
            //redirect the user to the home page on the subscription form
            echo "<script>window.location='index.php?error=stmtfailed#footer'</script>";
        }
        //bind the user parameter with stmt arguments
        mysqli_stmt_bind_param($stmt, "ss",$name, $email);
        //execute stmt
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $_SESSION['subscribe'] = "<div class='success text-center'>Subscribed to electro store news!</div>";
        echo "<script>window.location='index.php?subscribe=success#footer'</script>";
        exit();
    }
