<?php 
    //include constants file for session start
    include('config/constants.php');
    //unset and destroy all the sessions
    session_unset();
    session_destroy();
    //redirect customer to the index page
    header('location:'.SITEURL.'index.php');
?>