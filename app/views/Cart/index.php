<?php
   require APPROOT . '/views/includes/head.php';
?>
<?php
       require APPROOT . '/views/includes/nav_bar.php';
?>
	<div class="cart-landing">
		<div class="blabla">
        	<h1>Cart </h1>
		<p>Home / Cart</p>
        </div>
	</div>
	<br>
	<div class="cart-content">
		<div class="container">
			<div style="overflow-x:auto;">
			<table >
			<thead>
				<tr>
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$total1=0;
	        		foreach ($data['result'] as $row) {
				?> 
					  
	               <tr>
							<td><?= $row->book_title ?></td>
							<td><?= $row->price ?></td>
							<td><?= $row->quantity ?></td>
							<td><?= $row->total_price ?></td>
						</tr>
				<?php
					$total1 += $row->total_price;
					}
        		?>
			</table>
			</div>
		<div class="card-totals">
			
			<h1>Card Totals</h1>
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
		<form class="checkout" action="<?= URLROOT ?>/CheckOut/index">
			<button>proceed to checkout</button>
		</form>
		<form class="save_changes" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<button>Save Changes</button>
		</form>
		<a class="continue" href="<?= URLROOT ?>/Books/index">Continue Shopping</a>
		</div>
	</div>
   <?php
   require APPROOT . '/views/includes/footer.php';
	?>
</body>
</html>