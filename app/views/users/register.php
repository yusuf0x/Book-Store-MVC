<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>
 <div class="register-container">
       <div class="error">
       <?= $data["error"]?>
       </div>
        <h1>Register</h1>
        <form action="<?php echo URLROOT; ?>/Users/register" method="post">
            <!-- <label for="">UserName</label> -->
            <input type="text" name="username" id="" placeholder="username">
            <!-- <span class="error" style="color: red;"><?php echo $usernameErr;?></span> -->
            <!-- <label for="">Email</label> -->
            <input type="email" name="email" id="" placeholder="email">
            <!-- <span class="error" style="color: red;"><?php echo $emailErr;?></span> -->
            <!-- <label for="">Password</label> -->
            <input type="password" name="password" id="" placeholder="password">
            <!-- <span class="error" style="color: red;"><?php echo $passwordErr;?></span> -->
            <!-- <label for="">phone</label> -->
            <input type="tel" name="phone" id="" placeholder="tel">
            <!-- <span class="error" style="color: red;"><?php echo $phoneErr;?></span> -->
            <!-- <label for="">Address</label> -->
            <textarea name="address" id="" cols="30" rows="10" placeholder="address"></textarea>
            <!-- <span class="error" style="color: red;"><?php echo $addressErr;?></span><br> -->
            <input id="submit" class="button" type="submit" name="submitButton" value="Submit">
            <input id="forget" class="button" type="button" name="cancel" value="Cancel"  onClick="window.location='<?php echo URLROOT; ?>/Home/index';" />
        </form>
</div>


