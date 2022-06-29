<?php
    //check if the admin is log in 
    if(!isset($_SESSION['customer_user'])){
        $_SESSION['not-logged-in'] = "<p class='error text-center'>Login to continue shopping!</p>";
        header('location:'.SITEURL.'login.php');
    }