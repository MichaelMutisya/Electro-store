<?php
    include('../config/constants.php');
    include('login-check.php');  
?>
      <header class="menu-section">
        <div class="wrapper">
            <div class="admin">
                <a href="<?php echo SITEURL; ?>admin/manage-admins.php"><?php echo $_SESSION['user']; ?><img src="../images/icons8-user-64.png" alt="admin image"></a>
                <a href="<?php echo SITEURL; ?>admin/logout.php">Logout</a>
            </div>
            <div class="menu-container">
                <div class="logo">
                    <h4>ELECTRO <span>STORE </span><i class="fa-solid fa-sd-card"></i></h4>
                </div>
                <nav class="menu">
                    <ul>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/index.php">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/manage-admins.php">Admin</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/manage-products.php">Products</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/manage-categories.php">Categories</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/manage-customers.php">Customers</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/manage-orders.php">Orders</a>
                        </li>
                        <li>
                            <a href="<?php echo SITEURL;?>admin/manage-stores.php">Stores</a>
                        </li>
                    </ul>
                </nav>
            </div> 
        </div> 
    </header>