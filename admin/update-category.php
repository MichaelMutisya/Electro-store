<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META CHARSET --> 
    <meta charset="UTF-8">
    <!-- META EDGE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- META VIEWPORT -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>Electro Store - Admin control panel update category </title>
    <!-- META DESCRIPTION -->
    <meta name="description" content="Electro store is a shopping platform for the best and high quality of kitchen,office, 
    living room and other types of electronic for famous brands. We ensure satisfaction to our customer. We offer free 
    delivery on goods order amount above Ksh 500000 within Nairobi, Mombasa and Kisumu">
    <!-- META KEYWORDS -->
    <meta name="keywords" content="HP SAMSUNG SONY HISENSE DELL HUAWEII PHILLIPS RAMTONS ">
    <!-- META AUTHOR -->
    <meta name="author" content="Michael Mutisya">

    <!-- FAVICON-->
    <link  rel="shortcut icon" type="image/ico" href="../images/favicon.ico">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CASCADING STYLE SHEET -->
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <!--menu-section starts here section-->
    <?php include('partials/header.php'); ?>
    <!--menu-section ends here section-->

    <!--main-section starts here section-->
    <section class="main-section">
        <div class="wrapper">
            <div class="form-control">
                <div class="form-title">
                    <h2>Update Category</h2>
                </div>
                <div class="form-content">
                <?php
                        ob_start();
                        //check if category id is set
                        if(isset($_GET['category_id'])){
                            //get the id of the selected category
                            $category_id = $_GET['category_id'];

                            //SQL query to get the details of the category from the database
                            $sql = "SELECT * FROM tbl_categories WHERE category_id=$category_id";

                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //Test if the query is executed
                            if($res == true){
                                //check whether data is available or not
                                $count = mysqli_num_rows($res);
                                //test whether category data with id given is available or not
                                if($count == 1){
                                //get the data
                                $row = mysqli_fetch_assoc($res);
                                
                                $category_name= $row['category_name'];
                                $image_name = $row['image_name'];
                                $active = $row['active'];
                                $featured = $row['featured'];
                                }
                                else{
                                    //redirect to the manage categories page
                                    header('location:'.SITEURL.'admin/manage-categories.php');
                                    ob_end_flush();
                                }
                            }
                        }
                        else{
                            //redirect to the manage categories page
                            header('location:'.SITEURL.'admin/manage-categories.php');
                            ob_end_flush();
                        }
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr> 
                                <td>Update Category Name:</td> 
                                <td><input type="text" name="category_name" required autofocus value="<?php echo $category_name; ?>"></td>   
                            </tr>
                            <tr>
                                <td>Current Category Image:</td>
                                <?php
                                        if($image_name == ""){
                                            //print error message image not found
                                            ?>
                                            <td><?php echo "<p class='error'>Image not found</p>"?></td>
                                            <?php
                                        }
                                        else{
                                            //display the image of the category
                                            ?>
                                            <td><img src="<?php echo SITEURL."images/categories/".$image_name; ?>" style="width: 80px; height: 60px;" ></td>
                                            <?php
                                        }
                                ?>
                            </tr>
                            <tr>
                                <td>Upload New Category Image:</td>
                                <td><input type="file" name="new_image"></td>
                            </tr>
                            <tr>
                                <td>Active:</td>
                                <?php
                                    if($active == "Yes"){
                                        //select yes radio button
                                        ?>
                                        <td>
                                            <input type="radio" name="active" value="Yes" checked>Yes
                                            <input type="radio" name="active" value="No">No
                                        </td>
                                        <?php
                                    }
                                    else{
                                        //select no radio button
                                        ?>
                                        <td>
                                            <input type="radio" name="active" value="Yes">Yes
                                            <input type="radio" name="active" value="No" checked>No
                                        </td>
                                        <?php
                                    }
                                ?>
                            </tr>
                            <tr>
                                <td>Featured:</td>
                                <?php
                                    if($featured == "Yes"){
                                        //select yes radio button
                                        ?>
                                        <td>
                                            <input type="radio" name="featured" value="Yes" checked>Yes
                                            <input type="radio" name="featured" value="No">
                                        </td>
                                        <?php
                                    }
                                    else{
                                        //select no radio button
                                        ?>
                                        <td>
                                            <input type="radio" name="featured" value="Yes">Yes
                                            <input type="radio" name="featured" value="No" checked>No
                                        </td>
                                        <?php
                                    }
                                ?>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="current_image" value="<?php echo $image_name; ?>"></td> 
                                <td><input type="submit" name="update_category" value="Update Category" class="btn secondary"></td>
                            </tr> 
                            
                        </table>
                    </form>
                    <?php
                        //check if update category button is clicked
                        if(isset($_POST['update_category'])){
                            //1.Collect all the values from the form
                            $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                            $current_image = $_POST['current_image'];
                            //check if radio button for active is clicked
                            if(isset($_POST['active'])){
                                //if clicked get value from form
                                $active = $_POST['active'];
                            }
                            else{
                                //else set default value
                                $active = "No";
                            }

                            //check if radio button for featured is clicked
                            if(isset($_POST['featured'])){
                                //if clicked get value from form
                                $featured = $_POST['featured'];
                            }
                            else{
                                //else set default value
                                $featured = "No";
                            }
                            //2.Update new image
                            //check if image of the category is selected
                            if($_FILES['new_image']['name']){
                                //1.upload the image
                                //to upload the image we need to set image name, source path and destination path
                                //setting image name
                                $new_image = $_FILES['new_image']['name'];

                                //check if the image is selected

                                //auto rename the image name
                                //first we get the image extension 
                                $ext = end(explode('.', $new_image));
            
                                //rename the image name
                                $new_image = $category_name.rand(000,999).'.'.$ext;
                                //source path
                                $source_path = $_FILES['new_image']['tmp_name'];
            
                                //destination path
                                $destination_path = "../images/categories/".$new_image;
                                //lastly upload the image
                                $upload_image = move_uploaded_file($source_path, $destination_path);
                
                                //check if the image is uploaded successfully or not
                                if($upload_image==false){
                                    //set an error message
                                    $_SESSION['upload'] = "<div class='error'>Image failed to be Uploaded</div>";
                
                                    //redirect to add category page and die the process to set data to the database
                                    echo "<script>window.location='manage-categories.php'</script>";
                                    //terminate the process
                                    die();
                                }
                                //2.remove the current image current image available
                                if($current_image !== ""){
                                    //set remove image path
                                    $remove_image_path = "../images/categories/".$current_image; 
                                    //remove the image
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
                            }
                            else{
                                //set the image name as current image and don't upload the image
                                $new_image = $image_name;
                            }
                            //3.Update the database
                            $sql2 = "UPDATE `tbl_categories` 
                            SET`category_name`='$category_name',
                            `image_name`='$new_image',
                            `active`='$active',
                            `featured`='$featured' 
                            WHERE category_id=$category_id";
                            //4.Execute the query
                            $res2 = mysqli_query($conn, $sql2);
                            //5.Redirect to manage category page
                            //check if the query is executed
                            if($res2 == true){
                                //update category then redirect to manage category page
                                $_SESSION['update-category'] = "<div class='success'>Category updated successfully!</div>";
                                header('location:'.SITEURL.'admin/manage-categories.php');
                            }
                            else{
                                //redirect to manage category page with a failed error message
                                $_SESSION['update-category'] = "<div class='error'>Failed to update category!</div>";
                                header('location:'.SITEURL.'admin/manage-categories.php');
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!--main-section ends here section-->
    
    <!--footer-section starts here section-->
    <?php include('partials/footer.php'); ?>
    <!--footer-section ends here section-->
</body>
</html>