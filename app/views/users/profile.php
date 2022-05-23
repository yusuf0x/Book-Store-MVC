<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>
     <?php 
                    $result = $data['user'];
    ?>
    <div class="profile_container">
            <div id="main-card">
                <div class="cover-photo"><img class="image1" src="<?=URLROOT?>/public/img/background.jpg"></div>
                <div class="photo">
                    <img class="image" src="<?=URLROOT?>/public/img/profile.png" alt="">
                </div>
                <div class="content_user">
                    <h2 class="name"><?= $result->username;?></h2>
                    <h3 class="phone"><?= $result->phone ?></h3>
                    <h3 class="address-1">
                         <a href="#" class="address">O<?= $result->address ?></a>
                     </h3>
                     <h3 class="email">
                        <a class="email-href" href="mailto:".<?= $result->email ?>><?= $result->email ?></a>
                    </h3>
                </div>
                <div class="contact_user">
                    <ul>
                        <a href="#"><i class="i-css fa-brands fa-dribbble"></i></a> 
                        <a href="#"><i class="i-css fa-brands fa-twitter"></i></a>  
                        <a href="#"><i class="i-css fa-brands fa-linkedin"></i></a>  
                        <a href="#"><i class="i-css fa-brands fa-facebook"></i></a> 
                    </ul>
                </div>
         </div>
    </div>
    <div class="cart-content">
        <div class="container">
            <h1>Your Order</h1>
            <div style="overflow-x:auto;">
                <table >
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Date purchase</th>
                        <th>Quantity</th>
                        <th>Total price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total1 = 0;
                        if ($data['orders']) {
                            foreach ($data['orders'] as $row) 
                            {
                    ?>      <tr>
                                <td><?= $row->book_title ?></td>
                                <td><?= $row->date_purchase ?></td>
                                <td><?= $row->quantity ?></td>
                                <td><?= $row->total_price ?></td>
                            </tr>
                    <?php
                            $total1 += $row->total_price;
                            }
                        }else{
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                    <?php
                        }
                    ?>
               
                </tbody>
                </table>
             </div>
            <div class="card-totals">
                
                <h1>Order Totals</h1>
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td><?= $total1 ?></td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>+$10</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><?= $total1 + 10 ?></td>
                    </tr>
                </table>
            </div>
    
           <div class="generate">
            <h2>Generate PDF file for ur Order</h2><br>
                <form class="" method="post" action="<?=URLROOT?>/CheckOut/gen_pdf">
                    <button  class="button-gen" type="submit" id="pdf" name="generate_pdf" class="">
                        <!-- <i class="fa fa-pdf" aria-hidden="true"></i> -->
                        <i class="fa-solid fa-file-pdf"></i>
                        Generate PDF
                    </button>
                </form>
           </div>
    
        </div>
    </div>
    <!-- </div> -->
</body>
</html>
