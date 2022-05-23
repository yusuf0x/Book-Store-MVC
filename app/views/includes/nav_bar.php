<div class="header">
        <div class="container">
        <a href="<?php echo URLROOT; ?>/Home/index" class="logo-text">
            <!-- <img class="logo" src="images/images.jpeg" alt=""> -->
            BookStore
        </a>

        
                <ul>
                    <li><a href="<?php echo URLROOT; ?>/Home/index">Home</a>
                    <li><a href="<?php echo URLROOT; ?>/Books/index">Books</a></li>
                    <div class="hh"></div>
                    <?php
                    // session_start();
                    // var_dump($_SESSION);
                    if(isset($_SESSION["user_id"])){
                    ?>
                        
                            <li><a href="<?php echo URLROOT; ?>/Users/profile">Profile</a></li>
                            <li><a href="<?php echo URLROOT; ?>/Users/logout">Logout</a></li>
                    
                    <?php
                    }
                    if(!isset($_SESSION["user_id"])){
                        ?>
                        <!-- echo ' -->
                            <li><a href="<?php echo URLROOT; ?>/Users/login">Login</a></li>
                            <li><a href="<?php echo URLROOT; ?>/Users/register">Register</a></li>
                        <!-- '; -->
                    <?php
                    }
                    ?>
                </ul>
                <i style="display: none;" class="fa-solid fa-bars"></i>
</div></div>