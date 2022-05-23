<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>
    <!--  -->
    <div class="landing">
        <div class="blabla">
         <h1>Our Books</h1>
            <p>Home/books</p>
        </div>
    </div>
    <div class="grouping">
        <div class="container">
            <form action="<?php echo URLROOT;?>/Books/index" method="GET">
                <input type="text" placeholder="book title" name="book_name">
                <select name="type" id="" >
                    <option value="">Type</option>
                    <?php
                        foreach ($data['types'] as $type) {
                    ?>
                                <option value="<?= $type->type ?>" ><?= $type->type ?></option>
                        
                    <?php
                        }
                    ?>
                </select>
                <select name="author" id="">
                    <option value="">Author</option>
                    <?php 
                        foreach ($data['authors'] as $author) {
                    ?>
                            <option value="<?= $author->author ?>" ><?= $author->author ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input class="search" type="submit" name="" value="Search for Books">
            </form>
        </div>
    </div>
    <!--  -->
    <div class="popular-book">
        <div class="container">
               <div class="popular-content">
                    <?php
                        foreach ($data['result'] as $book) {
                    ?>
                            <div class="book-card">
                                <img src="<?= URLROOT ?>/public/img/<?= $book->image ?>" alt="">
                                <h3><?= $book->book_title ?></h3>
                                <p><?= $book->author ?></p>
                                <p><?= $book->price ?></p>
                                <form action="<?php echo URLROOT; ?>/BookDetail/index/<?= $book->book_id ?>" method="GET">
                                    <input type="submit" value="Detail">
                                </form>
                            </div>
                    <?php   
                         }   
                    ?>
                </div> 
                <div class="pag">
                    <div class="pagination">
                            <?php

                                if (!isset ($_GET['page']) ) {  
                                    $page_number = 1;  
                                } else {  
                                    $page_number = $_GET['page'];  
                                }     
                                $pg = $page_number;
                                for($page_number = 1; $page_number<= $data['total_pages']; $page_number++) {  
                                    if($page_number==$pg)  {
                                ?>
                                        <a class="active" href = "<?= URLROOT ?>/Books/index?page=<?= $page_number ?>"><?= $page_number ?></a>
                                <?php
                                    }else{
                                ?>
                                        <!-- // echo '<a  href = "<?= URLROOT ?>/Books/index?page='.$page_number.'&book_name='.$book_name.'&type_book='.$type_book.'&author='.$Author.'">' . $page_number . ' </a>';  -->
                                        <a href = "<?= URLROOT ?>/Books/index?page=<?= $page_number ?>"><?= $page_number ?></a>
                                <?php
                                    }
                                }    
                            ?>
                    </div> 
               </div>
        </div>
    </div>
    <!--  -->
   <?php
   require APPROOT . '/views/includes/footer.php';
?>
</body>
</html>
