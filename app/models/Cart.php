<?php

	/**
	 * 
	 */
	class Cart
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database;
			// $this->AddToCart();
		}
		public function getBookInCartbyId($id){
			$this->db->query("SELECT c.book_id,c.price,c.quantity,c.total_price,b.book_title FROM Cart c JOIN book b on c.book_id=b.book_id WHERE c.user_id=:id");
			$this->db->bind(":id",$id);
			return $this->db->resultSet();
		}
		public function AddToCart($params){
			$ID = $_SESSION['user_id'];
			$this->db->query("SELECT * FROM Cart");
			$result = $this->db->resultSet();
			foreach ($result as $row) {
	                $bookID = $row->book_id;
	                $Id = $row->user_id;
	                if ($bookID ==  (int)$params && $Id == $ID) {
	                	$flag = 1;
	                	break;
	                }
	        }
	        if ($flag) {
	        	echo "Repeated"."<br>";
	        }else{

				$this->db->query("SELECT * FROM book WHERE book_id=:book_id");
				// $this->db->bind(":book_id",$_POST['add_to_cart']);
				$this->db->bind(":book_id",(int)$params[0]);
				$result = $this->db->single();
				// if (isset($_POST["add_to_cart"])) {
					// $ID = $_POST['add_to_cart'];
				$ID = (int)$params[0];
				$quantity = $_GET['quantity'];
				$this->db->query("INSERT INTO Cart(user_id,book_id,price,quantity,total_price) VALUES(:id,:book_id,:price,:quantity,:total_price)");
					
				$this->db->bind(":id",$_SESSION['user_id']);
				$this->db->bind(":book_id",$ID);
				$this->db->bind(":price",$result->price);
				$this->db->bind(":quantity",$quantity);
				$this->db->bind(":total_price",$quantity*$result->price);
				$this->db->execute();

			}
		}
	}