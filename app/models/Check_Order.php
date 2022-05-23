<?php 

	/**
	 * 
	 */
	 
	class Check_Order 
	{
		private $db;
		public function __construct()
		{
			$this->db = new Database;
			// echo "Hello";
		}

		public function SaveCustomerAndOrder($data){
			 $this->db->query("INSERT INTO Customer(customer_name,customer_email,customer_phone,customer_country,customer_address,customer_city,customer_province,customer_postcode,user_id	) 
			 	VALUES(:customer_name,:customer_email,:customer_phone,:customer_country,:customer_address,:customer_city,:customer_province,:customer_postcode,:user_id)");
			 $this->db->bind(":customer_name",$data['username']);
			 $this->db->bind(":customer_email",$data['email']);
			 $this->db->bind(":customer_phone",$data['phone']);
			 $this->db->bind(":customer_country",$data['country']);
			 $this->db->bind(":customer_address",$data['address']);
			 $this->db->bind(":customer_city",$data['city']);
			 $this->db->bind(":customer_province",$data['province']);
			 $this->db->bind(":customer_postcode",$data['postcode']);
			 $this->db->bind(":user_id",$_SESSION['user_id']);
			 if (!$this->db->execute()) {
			 	return false;
			 }

			 $this->db->query("SELECT customer_id from Customer WHERE customer_name =:name and user_id=:user_id");
			 $this->db->bind(":name",$data['username']);
			 $this->db->bind(":user_id",$_SESSION['user_id']);
			 $res1 = $this->db->single();
			 // var_dump($res1);
			 if (!$res1) {
			 	return false;
			 }
			 // var_dump($res1);

			 $this->db->query("SELECT * FROM Cart WHERE user_id=:user_id");
			 $this->db->bind(":user_id",$_SESSION['user_id']);
			 $result = $this->db->resultSet();
			 // var_dump($result);
			 foreach ($result as $cart) {
			 	$this->db->query("INSERT INTO `Order`(customer_id, book_id, date_purchase, quantity, total_price, status) VALUES(:customer_id,:book_id,CURRENT_TIME,:quantity,:total_price, 'N')");
			 	$this->db->bind(":customer_id",$res1->customer_id);
			 	$this->db->bind(":book_id",$cart->book_id);
			 	$this->db->bind(":quantity",$cart->quantity);
			 	$this->db->bind(":total_price",$cart->total_price);
			 	if(!$this->db->execute()){
			 		return false;
			 	}
			 }
			 return true;

			 // $sql = "DELETE FROM Cart";



		}
	}
