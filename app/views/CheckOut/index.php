<?php
   require_once APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>

    <div class="chack-landing">
       <div class="blabla">
            <h1>CheckOut</h1>
        <p>Home / checkout</p>
       </div>
    </div>


<!-- if(isset($_SESSION['id'])){ -->
<!-- ?> -->
    <div class="hola">
        
    </div>
   <div class="check-container">

      <div class="container">
            <div class="table">
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td>SubTotal</td>
                        <td>$1000.00</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>$10</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$1000000</td>
                    </tr>
                </table>

            </div>
           <div class="check-form">

               <form method="POST" action="<?= URLROOT ?>/CheckOut/save">
                <!-- <span class="error"><?= $Error ?></span> -->
                <input class="first" type="text" name="name" placeholder="name"><br>
                <!-- <span class=""><?= $nameErr ?></span> -->
                <input type="email" name="email" placeholder="Email Address"><br>
                <input type="tel" name="phone" placeholder="Phone"><br>
                <input type="text" name="country" placeholder="Country"><br>
                <input type="text" name="address" placeholder="Address"><br>
                <input type="text" name="city" placeholder="Town/City"><br>
                <input type="text" name="province" placeholder="province"><br>
                <input type="text" name="postcode" placeholder="postcode/zip"><br>
                <!-- <input type="submit" name="submitButton" placeholder="postcode/zip"><br> -->
                <!-- <input id="submit" type="submit" name="submitButton" value="Place Order"> -->
                <button id="submit" name="submitButton">Place Order</button>
                </form> 
           </div>
           
      </div>
   </div>
<!-- <?php
// }else{
//     header("Location:index.php");
// }
?> -->
   
      <?php
   require APPROOT . '/views/includes/footer.php';
?>
</body>
</html>