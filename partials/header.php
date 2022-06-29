
      <header id="menu-section" class="menu-section">
        <div class="wrapper">
            <?php
                if(!isset($_SESSION['customer_user'])){
                    ?>
                    <div class="account-login">
                        <a href="<?php echo SITEURL;?>login.php#login">Login</a>
                        <a href="<?php echo SITEURL;?>login.php#register">Register</a>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="account-login">
                        <span style="margin-top: 3px;">Hi, </span>
                        <a href="<?php echo SITEURL; ?>account.php"><?php echo $_SESSION['customer_user']; ?></a>
                        <a href="<?php echo SITEURL; ?>logout.php">Logout</a>
                        <br>
                        <br>
                    </div>
                    <?php
                }
            ?>
            <div class="menu-container">
                <div class="logo">
                    <h4>ELECTRO <span>STORE </span><i class="fa-solid fa-sd-card"></i></i></h4>
                </div>
                <div class="search-input">
                    <form action="search-products.php" method="GET" class="search-form">
                        <div class="form-controller">
                            <input type="search" name="product_searched" class="input-text" placeholder="Search for electronics here...">
                            <i class="fa fa-search"></i>  
                        </div>
                        <button type="submit" name="search" class="btn search-btn">SEARCH</button>
                    </form>
                </div>
                <nav class="menu">
                    <ul>
                        <li>
                            <a href="<?php echo SITEURL;?>index.php">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>products.php">Products</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                            <span class="cart-label text-center">0</span>
                        </li>
                    </ul>
                </nav>
            </div> 
        </div> 
    </header>