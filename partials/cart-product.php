<?php
    function cartProduct(){
        $element  = "
        <div class=\"product\">
            <div class=\"cart-product-card\">
                <div class=\"product-img\">
                    <img src=\"images/products/hp_desktop_cpu.jpg\" title=\"product image\" class=\"img-responsive\">
                </div>
                <div class=\"product-description\">
                    <h4>Hp desktop CPU</h4>
                    <div class=\"rating\">
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-solid fa-star\"></i>
                        <i class=\"fa-regular fa-star\"></i>
                    </div>
                    <h4>Ksh. 34565</h4>
                    <button type=\"submit\" class=\"btn danger\">REMOVE</button>
                </div>
            </div>
            <div class=\"quantity text-center\">
                <h4>Quantity</h4>
                <div class=\"quantity-input\">
                    <button class=\"btn danger\"><i class=\"fas fa-minus\"></i></button>
                    <input type=\"number\" value=\"1\" class=\"qnum\">
                    <button class=\"btn primary\"><i class=\"fas fa-plus\"></i></button>
                </div>
            </div>
        </div>
        ";
        echo $element;
    }
?>