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
    <title>Electro Store - Admin control panel add category </title>
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
                    <h2>Add Category</h2>
                </div>
                <div class="form-content">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr> 
                                <td>Enter Category Name:</td> 
                                <td><input type="text" name="category_name" required autofocus placeholder="Enter category name"></td>   
                            </tr>
                            <tr>
                                <td>Upload Category Image</td>
                                <td><input type="file" name="image_name"></td>
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
                                <td><input type="submit" name="add_category" value="Add Category" class="btn primary"></td>
                            </tr> 
                            
                        </table>
                    </form>
                    <?php
                        //check if add category button is clicked
                        if(isset($_POST['add_category'])){
                            //collect the data from the form
                            $category_name = mysqli_real_escape_string($conn, $_POST['category_name'])." "."Appliances";

                            //check if image of the category is selected
                            if($_FILES['image_name']['name']){
                                //upload the image
                                //to upload the image we need to set image name, source path and destination path
                                //setting image name
                                $image_name = $_FILES['image_name']['name'];

                                //check if the image is selected

                                //auto rename the image name
                                //first we get the image extension 
                                $ext = end(explode('.', $image_name));
            
                                //rename the image name
                                $image_name = $category_name.rand(000,999).'.'.$ext;
                                //source path
                                $source_path = $_FILES['image_name']['tmp_name'];
            
                                //destination path
                                $destination_path = "../images/categories/".$image_name;
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
                            }
                            else{
                                //set the image name as blank and don't upload the image
                                $image_name = "";
                            }

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
                             $sql = "INSERT INTO tbl_categories 
                             SET category_name = '$category_name',
                             image_name = '$image_name',
                             active = '$active',
                             featured = '$featured'";
             
                             //execute the query 
                             $res = mysqli_query($conn, $sql);
                             
                             //check if the query executed successfully or not
                             if($res == true){
                                 //set success message
                                 $_SESSION['add-category'] = "<div class='success'>Category added Successfully!</div>";
                                 //redirect to manage categories page
                                 echo "<script>window.location='manage-categories.php'</script>";
                             }
                             else{
                                 //set error message
                                 $_SESSION['add-category'] = "<div class='error'>Failed to add Category</div>";
                                 //redirect to manage categories page
                                 echo "<script>window.location='manage-categories.php'</script>";
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