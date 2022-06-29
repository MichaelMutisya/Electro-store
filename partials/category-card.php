<?php
    function categoryCard($title, $image_name, $category_id){
        $element = "
        <a href=\"category-items.php?category_id=$category_id\">
            <div class=\"card\">
                <h3>$title</h3>
                <img src=\"images/categories/$image_name\" alt=\"Category image\" title=\"$title\" class=\"img-responsive\">
            </div>
        </a>
        ";
        echo $element;
    }
?>