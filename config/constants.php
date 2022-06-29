<?php 
    //start a session
    session_start();
    //constant to hold web address homepage
    define('SITEURL', 'http://localhost/electro-store/');
    
    //define constant variables for server connection
    define('HOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'db_electro-store');

    //Server connection
    $conn = mysqli_connect(HOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Connection failed".mysqli_connect_error());  
?>