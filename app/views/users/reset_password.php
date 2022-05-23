<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>
   <div class="reset-password">
       <div class="container">
         <h1 class="">Reset Password</h1>

          <?php //flash('reset') ?>

          <form method="POST" action="<?= URLROOT ?>/ResetPasswords/sendEmail">
              <input type="hidden" name="type" value="send" />
              <input type="text" name="usersEmail" 
              placeholder="Email...">
              <button id="submit" type="submit" name="submit">Receive Email</button>
          </form>
   </div>

   </div>
<?php
   // require APPROOT . '/views/includes/footer.php';
?>