    <footer id="footer" class="footer-section">
        <section class="top-footer wrapper text-center">
            <div class="footer-container">
                <div class="footer-columns">
                    <h4>Get our Apps on</h4>
                    <div class="app-download">
                        <div class="platform">
                            <a href="#">
                                <h5>Playstore</h5>
                                <img src="https://img.icons8.com/fluency/48/undefined/google-play.png" class="img-hover"/>
                            </a>
                        </div>
                        <div class="platform">
                            <a href="#">
                                <h5>App Store</h5>
                                <img src="https://img.icons8.com/color/48/undefined/apple-app-store--v1.png" class="img-hover"/>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="footer-columns">
                    <div class="subscription">
                        <div class="logo">
                            <h4>ELECTRO <span>STORE </span><i class="fa-solid fa-sd-card"></i></i></h4>
                        </div>
                        <div class="subscription-description">
                            <p>
                                Subscribe to get the latest news about our new products when they arrive to our store
                            </p>
                        </div>
                        <div class="subscription-form">
                            <form action="" method="POST">
                                <?php
                                    //check if error session variable is set
                                    if(isset($_SESSION['error'])){
                                        //check if error message is set 
                                        if(isset($_GET['error'])){
                                            //check if stmt failed
                                            if($_GET['error'] == "stmtfailed"){
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                            }
                                            //check if email already exist
                                            else if( $_GET['error'] == "emailexist"){
                                                echo $_SESSION['error'];
                                                unset($_SESSION['error']);
                                            }
                                        }
                                    }
                                    //check if subscribe session variable is set
                                    if(isset($_SESSION['subscribe'])){
                                        //check if subscribe message is set 
                                        if(isset($_GET['subscribe'])){
                                            //check if subscribed
                                            if($_GET['subscribe'] == "success"){
                                                echo $_SESSION['subscribe'];
                                                unset($_SESSION['subscribe']);
                                            }
                                        }
                                    }
                                ?>
                                <table>
                                    <tr>
                                        <td>Name:</td>
                                        <td>
                                            <input type="text" name="name" placeholder="Enter your name">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td>
                                            <input type="email" name="email" placeholder="Enter your email">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="subscribe">Subscribe</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <?php
                                //check if subscribe button is click
                                if(isset($_POST['subscribe'])){
                                    //collect data from the form
                                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                                    $email = mysqli_real_escape_string($conn, $_POST['email']);


                                    //include form erro handler file to use subscribe email exist function and subscription registration
                                    include('config/form-error-handler.php'); 

                                    //check if email exist
                                    if(subscribe_email_exist($conn, $email) !== false){
                                        //set an error session variable
                                        $_SESSION['error'] = "<div class='error text-center'>Email already subscribed!</div>";
                                        //redirect the user to the home page on the subscription form
                                        echo "<script>window.location='index.php?error=emailexist#footer'</script>";
                                        exit();
                                    }         

                                    //subscribe to electro store news
                                    subscription_registeration($conn, $name, $email);
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="footer-columns">
                    <h4>Talk to us on our Social Media Platforms</h4>
                    <div class="social-media-platforms">
                        <div class="media-platform">
                            <a href="#"><img src="https://img.icons8.com/color-glass/48/undefined/twitter.png" class="img-hover"/> twitter</a>
                        </div>
                        <div class="media-platform">
                            <a href="#"><img src="https://img.icons8.com/color/48/undefined/facebook-new.png" class="img-hover"/> facebook</a>
                        </div>
                        <div class="media-platform">
                            <a href="#"><img src="https://img.icons8.com/fluency/48/undefined/instagram-new.png" class="img-hover"/>instagram</a>
                        </div>                            
                        <div class="media-platform">
                            <a href="#"><img src="https://img.icons8.com/color/48/undefined/whatsapp--v1.png" class="img-hover"/>+254702364845</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>              
        <section class="bottom-footer wrapper">
            <div class="footer-container">
                <div class="help-container">
                    <div class="controller">
                        <div class="top">
                            <a href="#top-section"><i class="fa-solid fa-square-caret-up"></i></a>
                        </div>
                    </div>
                    <div class="controller">
                        <div class="chatbot">
                            <i class="fa-solid fa-circle-question"></i>
                        </div>  
                    </div>
                </div>
            </div>
        </section>
    </footer>