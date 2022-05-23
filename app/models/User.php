<?php 
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (username, email, password,address,phone) VALUES(:username, :email, :password,:address,:phone)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        // if (password_verify($password, $hashedPassword)) {
        if ($password == $row->password) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function profile(){
        $id = $_SESSION['user_id'];
        $this->db->query("SELECT * FROM users WHERE UserID=:user_id");
        $this->db->bind(":user_id",$id);
        $user = $this->db->single();
        $data = [
            'user' => $user,
            'customer' => "",
            'orders' => ""
        ];
        $this->db->query("SELECT * FROM Customer WHERE user_id=:id");
        $this->db->bind(":id",$id);
        $customer = $this->db->single();
        $result = "";
        if ($customer) {
            $this->db->query("SELECT o.date_purchase,o.quantity,o.total_price,o.status,b.book_title,b.price FROM `Order` o join book b on o.book_id=b.book_id WHERE o.customer_id=:customer_id");
            $this->db->bind(":customer_id",$customer->customer_id);
            $result = $this->db->resultSet();

        }
        $data = [
            'user' => $user,
            'customer' => $customer,
            'orders' => $result,
        ];
        return $data;
    }
}
