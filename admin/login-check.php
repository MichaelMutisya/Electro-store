<?php
    //check if the admin is log in 
    if(!isset($_SESSION['user'])){
        $_SESSION['not-logged-in'] = "<p class='error text-center'>Login to get to admin panel!</p>";
        header('location:'.SITEURL.'admin/login.php');
    }