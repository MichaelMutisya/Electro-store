<?php    
    //include constants file to get constant variables
    include('../config/constants.php');

    //check if product id is set
    if(isset($_GET['product_id'])){
        //set product id
        $product_id = $_GET['product_id'];
        //delete product
        //1.remove the product image
        //SQL query to select product record to be deleted
        $sql2 = "SELECT * FROM `tbl_products` WHERE `product_id`='$product_id'";

        //execute the query 
        $res2 = mysqli_query($conn, $sql2);
        //check if the query has executed
        if($res2 == true){
            //select the image name from the database
            $row = mysqli_fetch_assoc($res2);
            $current_image = $row['image_name'];

            //check if current image is empty
            if($current_image !== ""){
                //set delete product session variable
                $remove_image_path = "../images/products/".$current_image; 
                $remove_image = unlink($remove_image_path);
                //check if the image is removed
                //if image not removed display error message and stop the process
                if($remove_image == false){
                    //failed to remove the image
                    $_SESSION['image-failed-remove'] = "<div class='error'>Image failed to be removed</div>";
                    header('location:'.SITEURL.'admin/manage-products.php');
                    //stop the process
                    die();
                }
            }
            else{
                $current_image = "";
            }
        }
        else{
            //set delete product session variable
            $_SESSION['delete-product'] = "<div class='error'>Failed to delete product. Try again later!</div>";
            //redirect admin to manage admin page
            header('location:'.SITEURL.'admin/manage-products.php');
            //stop the process
            die();
        }

        //2.delete product from the database
        //SQL query to delete the product record on the database
        $sql = "DELETE FROM `tbl_products` WHERE `product_id`='$product_id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed
        //3.redirect admin to manage products page
        if($res == true){
            //set a session variable variable delete product and redirect admin
            $_SESSION['delete-product'] = "<div class='success'>Product deleted successfully!</div>";
            //redirect admin to manage products page
            header('location:'.SITEURL.'admin/manage-products.php');
        }
        else{
            //set delete product session variable
            $_SESSION['delete-product'] = "<div class='error'>Failed to delete product. Try again later!</div>";
            //redirect admin to manage products page
            header('location:'.SITEURL.'admin/manage-products.php');
        }
    }
    else{
        //redirect admin to manage products page
        header('location:'.SITEURL.'admin/manage-products.php');
    }