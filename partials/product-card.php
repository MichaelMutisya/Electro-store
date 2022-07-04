<?php
    //check if add to chart is click
    if(isset($_POST['add'])){
        //check if cart session variable is set
        if(isset($_SESSION['cart'])){

            $product_array_id = array_column($_SESSION['cart'], "product_id");
            
            
            if(in_array($_POST['product_id'], $product_array_id)){
                echo "<script>alert('Already the product is in the cart!')</script>";
                echo "<script>window.location='index.php'</script>";
            }
            else{
                $count = count($_SESSION['cart']);
                $product_array = array('product_id'=>$_POST['product_id']);

                $_SESSION['cart'][$count] = $product_array;

            }
        }
        else{
            $product_array = array('product_id'=>$_POST['product_id']);

            //set new session variable
            $_SESSION['cart'][0] = $product_array;

            print_r($_SESSION['cart']);
        }
    }
    function productCard($image_name, $product_name, $short_description, $old_price, $new_price, $product_id){
        $element= "
        <div class=\"product-card\">
            <a href=\"product-description.php?product_id='$product_id'\" type=\"submit\">
                <form action=\"\" method=\"POST\">
                    <div class=\"product-card-img\">
                            <img src=\"images/products/$image_name\" alt=\"product image\" class=\"img-responsive\" style=\"height: 21vh;\">
                    </div>
                    <div>
                        <h4>$product_name</h4>
                    </div>
                    <div>
                        <p>$short_description</p>
                    </div>
                    <div class=\"rating\">
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-regular fa-star\"></i>
                    </div>
                    <div>
                        <small><s>Ksh. $old_price</s></small>
                        <h4>Ksh. $new_price</h4>
                    </div>
                    <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                    <div class=\".purchase\">
                        <button type=\"submit\" class=\"add img-responsive\" name=\"add\">Add to Cart <i class=\"fa fa-shopping-cart\"></i></button>
                        <button type=\"submit\" class=\"add img-responsive button-active\" name=\"add\">Remove <i class=\"fa fa-bin\"></i></button>
                    </div>
                </form>
        
            </a>
        </div>
        ";
        echo $element;
    }

    
