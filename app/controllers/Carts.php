<?php 

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
	/**
	 * 
	 */ 
	class Carts extends Controller
	{
		
		public function __construct()
		{
			$this->userModel = $this->model("Cart");
		}
		public function index($params=[]){
			if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) 
			{
				// var_dump($_SESSION['user_id']);
				$this->userModel->AddToCart($params);
				$book_in_cart = $this->userModel->getBookInCartbyId($_SESSION['user_id']);
				$data = [
					'title' => 'Cart',
					'result' => $book_in_cart
				];
				$this->view("Cart/index",$data);	
			}else{
				// $this->view("users/login");
				header("location:".URLROOT."/users/login");
			}
			
		}

	}