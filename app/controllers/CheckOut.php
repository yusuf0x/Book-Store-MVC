<?php 

	/**
	 * 
	 */ 
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	// require_once APPROOT.'/fpdf184/CevicheOne-Regular.php';
	class CheckOut extends Controller
	{
		
		public function __construct()
		{
			$this->userModel = $this->model("Check_Order");
		}
		public function index(){
			if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) 
			{
				$data = [
					'title' => 'Checkout'
				];
				$this->view("CheckOut/index");
			}else{
				header("location:".URLROOT."/users/login");
			}
		}
		public function save(){
			if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) 
			{
				$data = [
		            'username' => '',
		            'email' => '',
		            'country' => '',
		            'address' => '',
		            'phone' => '',
		            'province' => '',
		            'postcode' => '',
		            'city' => '',
		            'usernameError' => '',
		            'emailError' => '',
		            'countryError' => '',
		            'addressError' => '',
		            'phoneError' => '',
		            'provinceError' => '',
		            'postcodeError' => '',
		            'cityError' => ''
	       		 ];
	       		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		 //            // Process form
		 //        	// Sanitize POST data
		        	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					
		        		$data = [
			            'username' => trim($_POST['name']),
			            'email' => trim($_POST['email']),
			            'country' => trim($_POST['country']),
			            'address' => trim($_POST['address']),
			            'phone' => trim($_POST['phone']),
			            'province' => trim($_POST['province']),
			            'postcode' => trim($_POST['postcode']),
			            'city' => trim($_POST['city']),
			            'usernameError' => '',
			            'emailError' => '',
			            'countryError' => '',
			            'addressError' => '',
			            'phoneError' => '',
			            'provinceError' => '',
			            'postcodeError' => '',
			            'cityError' => ''
		       		 ];
		       		 $nameValidation = "/^[a-zA-Z0-9]*$/";
	            	$passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
		       		 // echo "HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH";
			       		 if (empty($data['username'])) {
			                $data['usernameError'] = 'Please enter username.';
			            } elseif (!preg_match($nameValidation, $data['username'])) {
			                $data['usernameError'] = 'Name can only contain letters and numbers.';
			            }else{
			            	echo "HH";
			            }

		 	           //Validate email
			            if (empty($data['email'])) {
			                $data['emailError'] = 'Please enter email address.';
			            }
			            elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			                $data['emailError'] = 'Please enter the correct format.';
			            } 
			               else {
			                //Check if email exists.
			                // if ($this->userModel->findUserByEmail($data['email'])) {
			                // $data['emailError'] = 'Email is already taken.';
			                	echo "HHH";
			                // }
			            }
			            // echo "HHHHH";

			           // Validate password on length, numeric values,
			            if(empty($data['country'])){
			              $data['countryError'] = 'Please enter country.';
			            }
			             if(empty($data['city'])){
			              $data['cityError'] = 'Please enter ur city.';
			            }
			             if(empty($data['province'])){
			              $data['provinceError'] = 'Please enter province.';
			            }
			             if(empty($data['postcode'])){
			              $data['postcodeError'] = 'Please enter postcode.';
			            }

			            //Validate addreess
			             if (empty($data['address'])) {
			                $data['addressError'] = 'Please enter address.';
			            }
			            //Validate Phone number
			             if (empty($data['phone'])) {
			                $data['phoneError'] = 'Please enter ur phone.';
			            }else{
			                if(!preg_match("/^[0-9 -]*$/", $_POST['phone'])){
			                    $data['phoneError']= "Please enter a valid phone number";
			                }
			            }
			            // echo "HHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH";
			             if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['countryError']) && empty($data['addressError']) && empty($data['phoneError']) && empty($data['cityError']) && empty($data['provinceError']) && empty($data['postcodeError'])) 
			             {
			             	if ($this->userModel->SaveCustomerAndOrder($data)) {
			             		header('location:'.URLROOT.'/Home/index');
			             	}else{
			             		 die("Something Wrong");
			             	}
			             }
	        		}
	        		$this->view("CheckOut/index",$data);
	        	}else{
	        		header("location:".URLROOT."/users/login");
	        	}
		}
		public function gen_pdf(){

			// if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) 
			// {	
				
					
					ob_start();
					$pdf = new FPDF();
					// $pdf->AliasNbPages();
					$pdf->AddPage();
					$pdf->SetFont('Times','',12);
					for($i=1;$i<=10;$i++)
					    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
					$pdf->Output();
					ob_end_flush(); 
					// $pdf = new FPDF();
					// $pdf->AddFont('CevicheOne','','CevicheOne-Regular.php');
					// $pdf->AddPage();
					// // $pdf->SetFont('Arial','B',16);
					// $pdf->SetFont('CevicheOne','',35);
					// $pdf->Write(10,'Enjoy new fonts with FPDF!');
					// // $pdf->Cell(40,10,'Hello World!');
					// $pdf->Output();
					
					// $pdf = new PDF();
					// $title = '20000 Leagues Under the Seas';
					// $pdf->SetTitle($title);
					// $pdf->SetAuthor('Jules Verne');
					// $pdf->PrintChapter(1,'A RUNAWAY REEF','20k_c1.txt');
					// $pdf->PrintChapter(2,'THE PROS AND CONS','20k_c2.txt');
					// $pdf->Output();

			// }else{
				
			// 	header("location:".URLROOT."/users/login");
			// }
		}	
		


	}