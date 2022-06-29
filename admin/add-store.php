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
    <title>Electro Store - Admin control panel add store </title>
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
                    <h2>Add Store</h2>
                </div>
                <div class="form-content">
                    <form action="" method="POST">
                        <table>
                            <tr> 
                                <td>Enter Store Name:</td> 
                                <td><input type="text" name="store_name" required autofocus placeholder="Enter store name"></td>   
                            </tr>
                            <tr>
                                <td>Enter Store Location:</td>
                                <td><input type="text" name="store_location" required placeholder="Enter store location"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name="add_store" value="Add Store" class="btn primary"></td>
                            </tr>   
                        </table>
                    </form>
                    <?php
                        //check if add store button is clicked
                        if(isset($_POST['add_store'])){
                            //collect the data from the form
                            $store_name = mysqli_real_escape_string($conn, $_POST['store_name']);
                            $store_location = mysqli_real_escape_string($conn, $_POST['store_location']);

                             //SQL to insert data to the database collected from the form
                             $sql = "INSERT INTO tbl_stores 
                             SET store_name = '$store_name',
                             store_location ='$store_location'";
             
                             //execute the query 
                             $res = mysqli_query($conn, $sql);
                             
                             //check if the query executed successfully or not
                             if($res == true){
                                 //set success message
                                 $_SESSION['add-store'] = "<div class='success'>Store added successfully!</div>";
                                 //redirect to manage categories page
                                 echo "<script>window.location='manage-stores.php'</script>";
                             }
                             else{
                                 //set error message
                                 $_SESSION['add-store'] = "<div class='error'>Failed to add store!</div>";
                                 //redirect to manage store page
                                 echo "<script>window.location='manage-stores.php'</script>";
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