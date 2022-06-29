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
    <title>Electro Store - Admin control panel update product </title>
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
                    <h2>Update Product</h2>
                </div>
                <div class="form-content">
                    <?php
                        ob_start();
                        //check if product id is set
                        if(isset($_GET['product_id'])){
                            //get the id of the selected product
                            $product_id = $_GET['product_id'];

                            //SQL query to get the details of the product from the database
                            $sql = "SELECT * FROM tbl_products WHERE product_id=$product_id";

                            //Execute the query
                            $res = mysqli_query($conn, $sql);

                            //Test if the query is executed
                            if($res == true){
                                //check whether data is available or not
                                $count = mysqli_num_rows($res);
                                //test whether product data with id given is available or not
                                if($count == 1){
                                //get the data
                                $row = mysqli_fetch_assoc($res);

                                $product_name= $row['product_name'];
                                $image_name = $row['image_name'];
                                $current_category_name = $row['category_name'];
                                $brand_name = $row['brand_name'];
                                $short_description = $row['short_description'];
                                $long_description = $row['long_description'];
                                $original_price = $row['original_price'];
                                $price = $row['price'];
                                $active = $row['active'];
                                $featured = $row['featured'];
                                }
                                else{
                                    //redirect to the manage products page
                                    header('location:'.SITEURL.'admin/manage-products.php');
                                    ob_end_flush();
                                }
                            }
                        }
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr> 
                                <td>Update Product Name:</td> 
                                <td><input type="text" name="product_name" required autofocus value="<?php echo $product_name; ?>"></td>   
                            </tr>
                            <tr>
                                <td>Current Product Image:</td>
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
                                        <td><img src="<?php echo SITEURL."images/products/".$image_name; ?>" style="width: 80px; height: 60px;" ></td>
                                        <?php
                                    }
                                ?>
                            </tr>
                            <tr>
                                <td>Upload New Product Image:</td>
                                <td>
                                    <input type="file" name="new_image">
                                </td>
                            </tr>
                            <tr>
                                <td>Select New Category:</td>
                                <td>
                                    <select name="category_name">
                                        <?php
                                            //query to select categories from the database
                                            $sql_select_category = "SELECT * FROM tbl_categories WHERE active='Yes'";
                                            //execute the query
                                            $result = mysqli_query($conn, $sql_select_category);

                                            //check if there is category in the database
                                            $count = mysqli_num_rows($result);
                                            if($count > 0){
                                                //if true display all categories active to the select menu
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $category_name = $row['category_name'];
                                                    ?>
                                                    <option <?php if($current_category_name == $category_name){ echo "selected"; }?> value="<?php echo $category_name; ?>"><?php echo $category_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            else{
                                                //else display no category found
                                                ?>
                                                <option value="0">No Category found</option>
                                                <?php
                                            }

                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Update Brand Name:</td>
                                <td><input type="text" name="brand_name" required value="<?php echo $brand_name; ?>"></td>
                            </tr>
                            <tr>
                                <td>Update Product Short Description:</td>
                                <td><input type="text" name="short_description" required value="<?php echo $short_description; ?>"></td>
                            </tr> 
                            <tr>
                                <td>Update Product long Description:</td>
                                <td>
                                    <textarea name="long_description" cols="34" rows="5"> <?php echo $long_description; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Update Price before discount:</td>
                                <td><input type="number" name="original_price" required placeholder="Price before discount" value="<?php echo $original_price; ?>"></td>
                            </tr>
                            <tr>
                                <td>Update Price after discount:</td>
                                <td><input type="number" name="price" required placeholder="Price after discount" value="<?php echo $price; ?>"></td>
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
                                            <input type="radio" name="featured" value="No">No
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
                                <td><input type="submit" name="update_product" value="Update Product" class="btn secondary"></td>
                            </tr>    
                        </table>
                    </form>
                    <?php
                        //check if update product button is clicked
                        if(isset($_POST['update_product'])){
                            //1.Collect all the values from the form
                            $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
                            $current_image = $_POST['current_image'];
                            $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                            $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
                            $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
                            $long_description = mysqli_real_escape_string($conn, $_POST['long_description']);
                            $original_price = mysqli_real_escape_string($conn, $_POST['original_price']);
                            $price = mysqli_real_escape_string($conn, $_POST['price']);
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
                            //check if image of the product is selected
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
                                $destination_path = "../images/products/".$new_image;
                                //lastly upload the image
                                $upload_image = move_uploaded_file($source_path, $destination_path);
                
                                //check if the image is uploaded successfully or not
                                if($upload_image==false){
                                    //set an error message
                                    $_SESSION['upload'] = "<div class='error'>Image failed to be Uploaded</div>";
                
                                    //redirect to add category page and die the process to set data to the database
                                    echo "<script>window.location='manage-products.php'</script>";
                                    //terminate the process
                                    die();
                                }
                                //2.remove the current image current image available
                                if($current_image !== ""){
                                    //set remove image path
                                    $remove_image_path = "../images/products/".$current_image; 
                                    //remove the image
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
                            }
                            else{
                                //set the image name as current image and don't upload the image
                                $new_image = $image_name;
                            }
                            //3.Update the database        
                            $sql2 = "UPDATE `tbl_products` 
                            SET
                            `product_name`='$product_name',
                            `category_name`='$category_name',
                            `brand_name`='$brand_name',
                            `short_description`='$short_description',
                            `long_description`='$long_description',
                            `active`='$active',
                            `featured`='$featured',
                            `image_name`='$new_image',
                            `original_price`='$original_price',
                            `price`='$price' 
                            WHERE `product_id`='$product_id'";
                            //4.Execute the query
                            $res2 = mysqli_query($conn, $sql2);
                            //5.Redirect to manage products page
                            //check if the query is executed
                            if($res2 == true){
                                //update product then redirect to manage products page
                                $_SESSION['update-product'] = "<div class='success'>Product updated successfully!</div>";
                                header('location:'.SITEURL.'admin/manage-products.php');
                            }
                            else{
                                //redirect to manage products page with a failed error message
                                $_SESSION['update-product'] = "<div class='error'>Failed to update product!</div>";
                                header('location:'.SITEURL.'admin/manage-products.php');
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