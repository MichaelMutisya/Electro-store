<?php

    //include constants file to start session and get constant variables
    include('../config/constants.php');

    //check if admin id is set
    if(isset($_GET['admin_id'])){
        //set admin id
        $admin_id = $_GET['admin_id'];
        //set sql query to select admin name to check if he/she is currently logged in
        $sql = "SELECT * FROM `tbl_admins` WHERE `admin_id`='$admin_id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query executed
        if($res == true){
            $row = mysqli_fetch_assoc($res);
        }
        else{
            //set delete admin session variable
            $_SESSION['delete-admin'] = "<div class='error'>Failed to delete admin. Try again!</div>";
            //redirect admin to manage admin page
            header('location:'.SITEURL.'admin/manage-admins.php');
            die();
        }
        //set admin logged in id
        $admin_logged_in_id = $row['admin_id'];
        //admin id match
        function admin_id_match($admin_id, $admin_logged_in_id){
            if($admin_id == $admin_logged_in_id){
                $result = true;
            }
            else{
                $result = false;
            }
            return $result;
        }
        //check if admin is login
        if(admin_id_match($admin_id, $admin_logged_in_id) == true){
            //delete admin then redirect to login page

            //1.delete admin
            //SQL query to delete the admin record on the database
            $sql2 = "DELETE FROM `tbl_admin` WHERE `admin_id`='$admin_id'";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            
            //check if the query is executed
            //2.redirect admin to login page or manage admin page
            if($res2 == true){
                //set a session variable variable delete admin and redirect admin
                //set delete admin session variable
                $_SESSION['delete-admin'] = "<div class='success'>You deleted yourself. Bye!</div>";
                //unset session and destroy session
                session_unset();
                session_destroy();
                //redirect admin to login page
                header('location:'.SITEURL.'admin/login.php');
            }
            else{
                //set delete admin session variable
                $_SESSION['delete-admin'] = "<div class='error'>Failed to delete yourself. Try again later!</div>";
                //redirect admin to manage admin page
                header('location:'.SITEURL.'admin/manage-admins.php');
            }
        }
        else{
            //1.delete admin
            //SQL query to delete the admin record on the database
            $sql2 = "DELETE FROM `tbl_admin` WHERE `admin_id`='$admin_id'";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            
            //check if the query is executed
            //2.redirect admin to manage admin page
            if($res2 == true){
                //set a session variable variable delete admin and redirect admin
                //set delete admin session variable
                $_SESSION['delete-admin'] = "<div class='success'>Admin deleted successfully!</div>";
                //redirect admin to manage admin page
                header('location:'.SITEURL.'admin/manage-admins.php');
            }
            else{
                //set delete admin session variable
                $_SESSION['delete-admin'] = "<div class='error'>Failed to delete admin. Try again later!</div>";
                //redirect admin to manage admin page
                header('location:'.SITEURL.'admin/manage-admins.php');
            }
        }
    }
    else{
        //redirect admin to manage admin page
        header('location:'.SITEURL.'admin/manage-admins.php');
    }