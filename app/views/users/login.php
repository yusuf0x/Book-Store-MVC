<?php
   require APPROOT . '/views/includes/head.php';
?>

<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>


<div class="login-container">
        <div class="error"><?= $data['error'] ?></div>
        <h1>Login</h1>
        <form method="POST" action="<?php echo URLROOT; ?>/Users/login">
            <!-- <label for="name">Username</label><br> -->

            <input type="text" id="name" name="username" placeholder="username"><br>
            <!-- <label for="password">Password</label><br> -->
            <input type="password" id="password" name="password" placeholder="password"><br>
            <input id="submit" class="button" type="submit" value="Login">
            <input id="forget" type="button" value="Cancel" name="cancel" class="button" onClick="window.location='<?php echo URLROOT; ?>/Home/index';">
            <input style="margin-bottom: 20px;display: block;" id="forget" type="button" value="reset password" class="button" onClick="window.location='<?php echo URLROOT; ?>/ResetPasswords/index';">
        </form>
</div>