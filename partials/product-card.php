<?php
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
                    <button type=\"submit\" class=\"add img-responsive\" name=\"addToCart\">Add to Cart <i class=\"fa fa-shopping-cart\"></i></button>
                </form>
                
            </a>
        </div>
        ";
        echo $element;
    }
?>