<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>

    <div class="landing_home">
            <div class="info">
                <p>Reading is the best  for get idea</p>
                <h1>Buy more Book for more Knowledge</h1>
                <a href="books.php">See More</a>
            </div>
     </div>
 
    <!--  -->
    <div class="popular-book">
        <div class="container">
            <div class="special-heading">
                <h1>Popular Books</h1>
            </div>
            <div class="popular-content">
            <!--  -->
            <?php
            // print_r($data);
           foreach ($data['books'] as $book){
            ?>  
                    <div class="book-card">
                        <img src="<?= URLROOT ?>/public/img/<?=  $book->image ?>" alt="">
                        <div class="content">
                            <h3><?= $book->book_title ?></h3>
                            <p><?=  $book->author ?></p>
                            <p><?= $book->price ?></p>
                        </div>
                        <div class="Detail">
                            <form action="<?php echo URLROOT; ?>/BookDetail/index/<?= $book->book_id ?>" method="POST">
                                <input type="submit" value="Detail">
                                <input type="hidden" value="<?= $book->book_id ?>" name="book_id_detail">
                            </form>
                        </div>
                    </div>
            <?php   
                }
            ?>
         </div>
        </div>
    </div>
    <!--  -->
    <div class="description">
        <div class="container">
            <div class="descrip">
                <i class="fa-solid fa-book"></i>
                <h1>Tons of Books</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium minus nulla quisquam 
                    magnam totam qui voluptatem quaerat error at aliquid ab consequuntur corrupti soluta obcaecati
                     modi hic impedit, ut illo.
                </p>
            </div>

            <!--  -->
            <div class="descrip">
                <i class="fa-solid fa-pen"></i>
                <h1>Hundreds of Author</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium minus nulla quisquam 
                    magnam totam qui voluptatem quaerat error at aliquid ab consequuntur corrupti soluta obcaecati
                     modi hic impedit, ut illo.
                </p>
            </div>
            <!--  -->
            <div class="descrip">
                <i class="fa-solid fa-bookmark"></i>
                <h1>Easily Bookmarked</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium minus nulla quisquam 
                    magnam totam qui voluptatem quaerat error at aliquid ab consequuntur corrupti soluta obcaecati
                     modi hic impedit, ut illo.
                </p>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="new-books">
        <div class="container">
            <div class="special-heading">
                <h1>New Books</h1>
            </div>
            <div class="new-content">
             <?php
           foreach ($data['books'] as $book){
            ?>  
                    <div class="book-card">
                        <img src="<?= URLROOT ?>/public/img/<?=  $book->image ?>" alt="">
                        <div class="content">
                            <h3><?= $book->book_title ?></h3>
                            <p><?=  $book->author ?></p>
                            <p><?= $book->price ?></p>
                        </div>
                        <div class="Detail">
                            <form action="<?php echo URLROOT; ?>/BookDetail/index/<?= $book->book_id ?>" method="POST">
                                <input type="submit" value="Detail">
                                <input type="hidden" value="<?= $book->book_id ?>" name="book_id_detail">
                            </form>
                        </div>
                    </div>
            <?php   
                }
            ?>
            <!--  -->
            </div>
        </div>
    </div>
    <!--  -->
    <div class="contact-us">
        <div class="container">
            <div class="contact">
                <h1>Contact Us </h1> 
           <!--      <p>Address </p>
                <p>marhba bik 3andna</p>
                <p><i class="fas fa-map-marker-alt"></i>  Morocco Dukala </p>
                <p><i class="fas fa-phone-alt"></i>   00000000000000000 </p>
                <p><i class="fas fa-envelope"></i> Blabla@gmail.com</p> -->
            </div>
            <div class="real-form">
               <form action="">
                    <label for="">Name</label>
                    <input type="text" name="Name" id="">
                    <label for="">Email</label>
                    <input type="text" name="email">
                    <label for="">Message</label>
                     <textarea class="input" placeholder="Tell Us About Your Needs" name="message"></textarea>
                    <input type="submit" value="send">
               </form>
            </div>
        </div>
    </div>
   <?php
   require APPROOT . '/views/includes/footer.php';
?>
</body>
</html>

