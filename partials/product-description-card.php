<?php
    function productDescriptionCard($image_name, $product_name, $short_description, $long_description, $old_price, $new_price){
        $element = "
        <div class=\"product-description\">
                <div class=\"gallery-description\">
                    <div class=\"product-image-description\">
                        <img src=\"images/products/$image_name\" class=\"img-responsive\">
                    </div>
                    <div class=\"change-image\">
                        <div><img src=\"images/products/$image_name\" class=\"img-responsive\"></img></div>
                        <div><img src=\"images/products/$image_name\" class=\"img-responsive\"></img></div>
                        <div><img src=\"images/products/$image_name\" class=\"img-responsive\"></img></div>
                        <div><img src=\"images/products/$image_name\" class=\"img-responsive\"></img></div>
                    </div>
                </div>
                <div class=\"short-description\">
                    <h3>$product_name</h3>
                    <div class=\"rating\">
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-regular fa-star\"></i>
                    </div>
                    <p>$short_description</p>
                    <h3><small><s>$old_price</s></small></h3>
                    <h3>$new_price</h3>
                    <form action=\"index.php\">
                        <button type=\"submit\" class=\"primary img-responsive\" name=\"add\">Add to Cart <i class=\"fa fa-shopping-cart\"></i></button>
                    </form>
                </div>
            </div>
            <div class=\"long-description\">
                <h4 class=\"text-center\">More description</h4>
                <p>$long_description</p>
            </div>
        ";
        echo $element;
    }