<?php 
	/**
	 * 
	 */
	// use PHPMailer\PHPMailer\PHPMailer;
 //    use PHPMailer\PHPMailer\SMTP;
 //    use PHPMailer\PHPMailer\Exception;

 //    require_once '../PHPMailer/src/PHPMailer.php';
	// require_once '../PHPMailer/src/Exception.php';
	// require_once '../PHPMailer/src/SMTP.php';
	class ResetPasswords extends Controller
	{
		private $resetModel;
    	private $userModel;
    	private $mail;
		function __construct()
		{
			$this->resetModel = $this->model("ResetPassword");
			// $this->resetModel = new ResetPassword;
	        // $this->userModel = new User;
	        //Setup PHPMailer
	        // $this->mail = new PHPMailer(true);
	        // $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
	        // $this->mail->SMTPOptions = [
	        //     'ssl' => [
	        //     'verify_peer' => false,
	        //     'verify_peer_name' => false,
	        //     'allow_self_signed' => true
	        //         ]
	        // ];
	        // $this->mail->isSMTP(); 
	        // // $this->mail->Host = 'smtp.google.com';
	        // $this->mail->Host = "localhost";
	        // $this->mail->SMTPAuth = false;
	        // $this->mail->Port = 25;
	        // $this->mail->Username = '';
	        // $this->mail->Password = '';

		}
		public function index(){
			$this->view("users/reset_password");
		}
		public function sendEmail(){
			//Sanitize POST data
	        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	        $usersEmail = trim($_POST['usersEmail']);

	        if(empty($usersEmail)){
	            // flash("reset", "Please input email");
	            // redirect("../reset-password");
	            header("location:".URLROOT."/ResetPasswords/index");
	            exit();
	        }

	        if(!filter_var($usersEmail, FILTER_VALIDATE_EMAIL)){
	            // flash("reset", "Invalid email");
	            header("location:".URLROOT."/ResetPasswords/index");
	            exit();
	        }
	        // //Will be used to query the user from the database
	        $selector = bin2hex(random_bytes(8));
	        // //Will be used for confirmation once the database entry has been matched
	        $token = random_bytes(32);
	        // //URL will vary depending on where the website is being hosted from
	        $url = URLROOT.'/ResetPasswords/create_new_password?selector='.$selector.'&validator='.bin2hex($token);
	        var_dump($url);
	        // //Expiration date will last for half an hour
	        $expires = date("U") + 1800;
	        if(!$this->resetModel->deleteEmail($usersEmail)){
	            die("There was an error");
	        }
	        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
	        if(!$this->resetModel->insertToken($usersEmail, $selector, $hashedToken, $expires)){
	            die("There was an error");
	        }
	        // //Can Send Email Now
	        $subject = "Reset your password";
	        $message = "<p>We recieved a password reset request.</p>";
	        $message .= "<p>Here is your password reset link: </p>";
	        $message .= "<a href='".$url."'>".$url."</a>";

	        // $this->mail->setFrom('T','admin');
	        // $this->mail->isHTML(true);
	        // $this->mail->Subject = $subject;
	        // $this->mail->Body = $message;
	        // $this->mail->addAddress($usersEmail);

	        // $this->mail->send();

	       
	        // header("location:".URLROOT."/ResetPasswords/index");
	        // exit();
	        // $this->view("users/create_new_password");

		}
		public function create_new_password(){
			$this->view("users/create_new_password");
		}
		public function resetPassword(){

		// public function create_new_password(){
			echo "<br><br>resetPassword";
				//Sanitize POST data
	        // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	        $data = [
	            'selector' => trim($_POST['selector']),
	            'validator' => trim($_POST['validator']),
	            'pwd' => trim($_POST['pwd']),
	            'pwd-repeat' => trim($_POST['pwd-repeat'])
	        ];
	        $url = URLROOT.'/ResetPasswords/create_new_password?selector='.$data['selector'].'&validator='.$data['validator'];

	        if(empty($_POST['pwd'] || $_POST['pwd-repeat'])){
	            // flash("newReset", "Please fill out all fields");
	            header("location: ".$url);
	            exit();
	        }else if($data['pwd'] != $data['pwd-repeat']){
	            // flash("newReset", "Passwords do not match");
	             header("location: ".$url);
	            exit();
	        }else if(strlen($data['pwd']) < 6){
	            // flash("newReset", "Invalid password");
	             header("location: ".$url);
	            exit();
	        }

	        $currentDate = date("U");
	        if(!$row = $this->resetModel->resetPassword($data['selector'], $currentDate)){
	            // flash("newReset", "Sorry. The link is no longer valid");
	             header("location: ".$url);
	            exit();
	        }

	        $tokenBin = hex2bin($data['validator']);
	        $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);
	        if(!$tokenCheck){
	        //     flash("newReset", "You need to re-Submit your reset request");
	        //     redirect($url);
	        	 header("location: ".$url);
	            exit();
	        }

	        $tokenEmail = $row->pwdResetEmail;
	        if(!$this->userModel->findUserByEmailOrUsername($tokenEmail, $tokenEmail)){
	        //     flash("newReset", "There was an error");
	        //     redirect($url);
	        	 header("location: ".$url);
	            exit();
	        }

	        $newPwdHash = password_hash($data['pwd'], PASSWORD_DEFAULT);
	        if(!$this->userModel->resetPassword($newPwdHash, $tokenEmail)){
	        //     flash("newReset", "There was an error");
	        //     redirect($url);
	        	 header("location: ".$url);
	            exit();
	        }

	        if(!$this->resetModel->deleteEmail($tokenEmail)){
	        //     flash("newReset", "There was an error");
	        //     redirect($url);
	        	 header("location: ".$url);
	            exit();
	        }

	        // flash("newReset", "Password Updated", 'form-message form-message-green');
	        // redirect($url);
	         header("location: ".$url);
	         exit();
		}

	}