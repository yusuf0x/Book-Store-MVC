<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>



    <div class="landing">
        <div class="blabla">
         <h1>Our Books</h1>
            <p>Home/books</p>
        </div>
    </div>

    <div class="detail">
        <div class="container">
            <div class="part1">
                <img class="logo" src=<?= URLROOT."/public/img/".$data['book']->image ?> alt="image" width="50%">
                <div class="info">
                    <h1><?= $data['book']->book_title ?></h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Omnis in cupiditate minus dolore itaque. Adipisci facilis alias debitis.</p>
                    <div class="price">
                        <p>$<?= $data['book']->price ?></p>
                        <form method="GET" action="<?php echo URLROOT; ?>/Carts/index/<?= $data['book']->book_id ?>">
                        <input type="number" value="1" name="quantity" style="width: 20%"/><br>
                        <!-- <input type="hidden" name="add_to_cart" value=<?= $data['book']->book_id ?>> -->
				        <input class="button" type="submit" value="Add To Cart"  />
                        </form>
                    </div>
                    <p class="category">Category:<?= $data['book']->type ?></p>
                </div>
            </div>
            <div class="part2">
                <div class="table_info">
                    <h1>About the Book</h1>
                    <table>
                        <tr>
                            <td>Pages</td>
                            <td>222 pages</td>
                        </tr>
                        <tr>
                            <td>publisher</td>
                            <td>On Fire</td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td>English</td>
                        </tr>
                        <tr>
                            <td>Relesesd</td>
                            <td>June 2013</td>
                        </tr>
                    </table>
                </div>
                <div class="author_info">
                    <div class="auth1">
                        <h3><?= $data['book']->author ?></h3>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Neque, tempore error blanditiis eaque quo libero aperiam voluptate deleniti eius labor</p>
                    </div>
                    <img class='logo' src="<?= URLROOT ?>/public/img/download.png" width="20%" height="20%" alt="" class="logo">
                </div>
            </div>
            <div class="part3">
                <h1>Description</h1>
                <p><?= $data['book']->book_descr ?></p>
            </div>
        </div>
    </div>
    <?php
   require APPROOT . '/views/includes/footer.php';
?>
</body>
</html>