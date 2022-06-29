<?php    
    //include constants file to get constant variables
    include('../config/constants.php');

    //check if category id is set
    if(isset($_GET['category_id'])){
        //set category id
        $category_id = $_GET['category_id'];
        //delete category
        //1.remove the category image
        //SQL query to select category record to be deleted
        $sql2 = "SELECT * FROM `tbl_categories` WHERE `category_id`='$category_id'";

        //execute the query 
        $res2 = mysqli_query($conn, $sql2);
        //check if the query has executed
        if($res2 == true){
            //select the image name from the database
            $row = mysqli_fetch_assoc($res2);
            $current_image = $row['image_name'];

            //check if current image is empty
            if($current_image !== ""){
                //set delete category session variable
                $remove_image_path = "../images/categories/".$current_image; 
                $remove_image = unlink($remove_image_path);
                //check if the image is removed
                //if image not removed display error message and stop the process
                if($remove_image == false){
                    //failed to remove the image
                    $_SESSION['image-failed-remove'] = "<div class='error'>Image failed to be removed</div>";
                    header('location:'.SITEURL.'admin/manage-categories.php');
                    //stop the process
                    die();
                }
            }
            else{
                $current_image = "";
            }
        }
        else{
            //set delete category session variable
            $_SESSION['delete-category'] = "<div class='error'>Failed to delete category. Try again later!</div>";
            //redirect admin to manage admin page
            header('location:'.SITEURL.'admin/manage-categories.php');
            //stop the process
            die();
        }

        //2.delete category from the database
        //SQL query to delete the category record on the database
        $sql = "DELETE FROM `tbl_categories` WHERE `category_id`='$category_id'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check if the query is executed
        //3.redirect admin to manage categories page
        if($res == true){
            //set a session variable variable delete category and redirect admin
            $_SESSION['delete-category'] = "<div class='success'>Category deleted successfully!</div>";
            //redirect admin to manage categories page
            header('location:'.SITEURL.'admin/manage-categories.php');
        }
        else{
            //set delete category session variable
            $_SESSION['delete-category'] = "<div class='error'>Failed to delete category. Try again later!</div>";
            //redirect admin to manage categories page
            header('location:'.SITEURL.'admin/manage-categories.php');
        }
    }
    else{
        //redirect admin to manage categories page
        header('location:'.SITEURL.'admin/manage-categories.php');
    }