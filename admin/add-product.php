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
    <title>Electro Store - Admin control panel add product </title>
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
                    <h2>Add Product</h2>
                </div>
                <div class="form-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr> 
                                <td>Enter Product Name:</td> 
                                <td><input type="text" name="product_name" required autofocus placeholder="Enter product name"></td>   
                            </tr>
                            <tr>
                                <td>Upload Product Image</td>
                                <td>
                                    <input type="file" name="image_name">
                                </td>
                            </tr>
                            <tr>
                                <td>Select Category:</td>
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
                                                    $category_id = $row['category_id'];
                                                    $category_name = $row['category_name'];
                                                    ?>
                                                    <option value="<?php echo $category_name; ?>"><?php echo $category_name; ?></option>
                                                    <?php
                                                }
                                            }
                                            else{
                                                //else display category data has no data
                                                ?>
                                                <option value="0">Categories table has no data</option>
                                                <?php
                                            }

                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Enter Brand Name:</td>
                                <td><input type="text" name="brand" required placeholder="Enter brand name"></td>
                            </tr>
                            <tr>
                                <td>Enter Product Short Description:</td>
                                <td><input type="text" name="short_description" required placeholder="Enter product short description"></td>
                            </tr> 
                            <tr>
                                <td>Enter Product long Description:</td>
                                <td>
                                    <textarea name="long_description" cols="34" rows="5" placeholder="Enter product long description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Enter Price before discount:</td>
                                <td><input type="number" name="original_price" required placeholder="Price before discount"></td>
                            </tr>
                            <tr>
                                <td>Enter Price after discount:</td>
                                <td><input type="number" name="price" required placeholder="Price after discount"></td>
                            </tr>  
                            <tr>
                                <td>Active</td>
                                <td>
                                    <input type="radio" name="active" value="Yes">Yes
                                    <input type="radio" name="active" value="No">No
                                </td>
                            </tr>
                            <tr>
                                <td>Featured</td>
                                <td>
                                    <input type="radio" name="featured" value="Yes">Yes
                                    <input type="radio" name="featured" value="No">No
                                </td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="add_product" value="Add Product" class="btn primary"></td>
                            </tr>   
                        </table>
                    </form>
                    <?php
                        //check if add product button is clicked
                        if(isset($_POST['add_product'])){
                            //collect the data from the form
                            $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);

                            //check if image of the category is selected
                            if($_FILES['image_name']['name']){
                                //upload the image
                                //to upload the image we need to set image name, source path and destination path
            
                                //setting image name
                                $image_name = $_FILES['image_name']['name'];
            
                                //auto rename the image name
                                //first we get the image extension 
                                $ext = end(explode('.', $image_name));
            
                                //rename the image name
                                $image_name = $product_name.rand(000,999).'.'.$ext;
            
                                //source path
                                $source_path = $_FILES['image_name']['tmp_name'];
            
                                //destination path
                                $destination_path = "../images/products/".$image_name;
            
                                //lastly upload the image
                                $upload_image = move_uploaded_file($source_path, $destination_path);
            
                                //check if the image is uploaded successfully or not
                                if($upload_image==false){
                                    //set an error message
                                    $_SESSION['upload'] = "<div class='error'>Image failed to be Uploaded</div>";
            
                                    //redirect to manage products page and die the process to set data to the database
                                    echo "<script>window.location='manage-products.php'</script>";
                                    //terminate the process
                                    die();
                                }
                            }
                            else{
                                //set the image name as blank and don't upload the image
                                $image_name = "";
                            }
                            $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
                            $brand_name = mysqli_real_escape_string($conn, $_POST['brand']);
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

                             //SQL to insert data to the database collected from the form
                             $sql = "INSERT INTO tbl_products 
                             SET product_name = '$product_name',
                             image_name = '$image_name',
                             category_name ='$category_name',
                             brand_name ='$brand_name',
                             short_description ='$short_description',
                             long_description = '$long_description',
                             original_price = '$original_price',
                             price = '$price',
                             active = '$active',
                             featured = '$featured'";
             
                             //execute the query 
                             $res = mysqli_query($conn, $sql);
                             
                             //check if the query executed successfully or not
                             if($res == true){
                                 //set add product session variable
                                 $_SESSION['add-product'] = "<div class='success'>Product added Successfully!</div>";
                                 //redirect to manage products page
                                 echo "<script>window.location='manage-products.php'</script>";
                             }
                             else{
                                 //set error message
                                 $_SESSION['add-product'] = "<div class='error'>Failed to add Product!</div>";
                                 //redirect to manage products page
                                 echo "<script>window.location='manage-products.php'</script>";
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