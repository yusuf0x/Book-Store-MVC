<?php
class Users extends Controller {
    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function register() {
        // $usernameErr = $passwordErr = $emailErr = $addressErr = $phoneErr = "";
        $data = [
            'title' => "Register",
            'username' => '',
            'email' => '',
            'password' => '',
            // 'confirmPassword' => '',
            'address' => '',
            'phone' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'addressError' => '',
            'phoneError' => '',
            'error' =>''
        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

              $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'address' => trim($_POST['address']),
                'phone' => trim($_POST['phone']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'addressError' => '',
                'phoneError' => '',
                'error' =>''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Email is already taken.';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Password must be at least 8 characters';
            } elseif (preg_match($passwordValidation, $data['password'])) {
              $data['passwordError'] = 'Password must be have at least one numeric value.';
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

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['addressError']) && empty($data['phoneError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
            else{
                $data['error'] = "Something Wrong try Again";
                $this->view('users/register', $data);   
            }
        }
        $this->view('users/register', $data);
    }
/*------------------------------------------------------*/
    public function login() {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => '',
            'error' => ''
        ];

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
                'error' => ''
            ];
            //Validate username
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                    $data['error'] = $data['passwordError'];
                    $this->view('users/login', $data);
                }
            }else{
                $data['error'] = 'Something Wrong try Again';
                 $this->view('users/login', $data);
            }

        } else {
            $data = [
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => '',
                'error' => 'Something Wrong ,Try Again'
            ];
        }
        $this->view('users/login', $data);
    }

    public function createUserSession($user) {
        // session_start();
        
        $_SESSION['user_id'] = $user->UserID;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/Home/index');
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }
    public function profile(){
        if (isset($_SESSION['user_id']) && isset($_SESSION['email']) && isset($_SESSION['username'])) 
            {
            
             $orders = $this->userModel->profile();
            if ($orders['orders'] && $orders["customer"]) {
                $data = [
                'title' => 'profile',
                'user' => $orders['user'],
                'customer' => $orders['customer'],
                'orders' => $orders['result'],
                ];    
            }else{
                $data = [
                'title' => 'profile',
                'orders' => "",
                'customer' => "",
                 'user' => $orders["user"]
                ];
            }
        
            $this->view("users/profile",$data);    
        }else
        {
            header("location:".URLROOT."/users/login");
        }
       
            
    }
}
