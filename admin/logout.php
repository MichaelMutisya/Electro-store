<?php 
    //include constants file for session start
    include('../config/constants.php');
    //unset and destroy all the sessions
    session_unset();
    session_destroy();
    //redirect the admin to the login page
    header('location:'.SITEURL.'admin/login.php');
?>
