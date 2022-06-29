<?php    
    //include constants file to get constant variables
    include('../config/constants.php');

    //check if customer id is set
    if(isset($_GET['customer_id'])){
        //set customer id
        $customer_id = $_GET['customer_id'];
        //delete customer
        //delete customer from the database
        //SQL query to delete the customer record on the database
        $sql = "DELETE FROM `tbl_customers` WHERE `customer_id`='$customer_id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed
        //3.redirect admin to manage customer page
        if($res == true){
            //set a session variable variable delete customer and redirect admin
            $_SESSION['delete-customer'] = "<div class='success'>Customer deleted successfully!</div>";
            //redirect admin to manage customers page
            header('location:'.SITEURL.'admin/manage-customers.php');
        }
        else{
            //set delete customer session variable
            $_SESSION['delete-customer'] = "<div class='error'>Failed to delete customer. Try again later!</div>";
            //redirect admin to manage customers page
            header('location:'.SITEURL.'admin/manage-customers.php');
        }
    }
    else{
        //redirect admin to manage customers page
        header('location:'.SITEURL.'admin/manage-customers.php');
    }