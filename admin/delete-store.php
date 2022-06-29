<?php    
    //include constants file to get constant variables
    include('../config/constants.php');

    //check if store id is set
    if(isset($_GET['store_id'])){
        //set store id
        $store_id = $_GET['store_id'];
        //delete store
        //delete store from the database
        //SQL query to delete the store record on the database
        $sql = "DELETE FROM `tbl_stores` WHERE `store_id`='$store_id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed
        //3.redirect admin to manage store page
        if($res == true){
            //set a session variable variable delete store and redirect admin
            $_SESSION['delete-store'] = "<div class='success'>Store deleted successfully!</div>";
            //redirect admin to manage stores page
            header('location:'.SITEURL.'admin/manage-stores.php');
        }
        else{
            //set delete store session variable
            $_SESSION['delete-store'] = "<div class='error'>Failed to delete store. Try again later!</div>";
            //redirect admin to manage stores page
            header('location:'.SITEURL.'admin/manage-stores.php');
        }
    }
    else{
        //redirect admin to manage stores page
        header('location:'.SITEURL.'admin/manage-stores.php');
    }