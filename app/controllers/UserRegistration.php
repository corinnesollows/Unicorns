<?php

class UserRegistration extends Controller{
	
    public $errorPassword2;
    public $errorEmail;
    
	public function signUp(){
		$this->view('Register/SignUp');
	}
    
    public function add() {
        global $errorEmail;
        global $errorPassword2;
        if($_POST['password'] == $_POST['password2']) {
            if(empty(UserRegistration::getUser())) {
                if(UserRegistration::insertUser()) {
                    $user = UserRegistration::getUser();
                    UserRegistration::insertCard($user);
                }
            }
            else $errorEmail = "Email already taken!";
        }
        else
            $errorPassword2 = "Passwords must match!";
        return $this->view('Register/SignUp');
    }
	
	public function insertUser(){
		$message = 'Please enter user data.';
		$user = $this->model('User');
		$DBConn = new DBConnection();

        $user->fname = $_POST['firstName'];
        $user->lname = $_POST['lastName'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->user_type = 'customer';
        $user->address = $_POST['address'];
        $user->city = $_POST['city'];
        $user->province = $_POST['province'];	
        $user->postal_code = $_POST['postalCode'];
        $user->phone_number = $_POST['phoneNumber'];

        if($user->isValid()){
            $stmt = $DBConn->connection->prepare('INSERT INTO user(fname, lname, email, password, user_type, address, city, province, postal_code, phone_number) VALUES (:fname, :lname, :email, :password, :user_type, :address, :city, :province, :postal_code, :phone_number)');
            $stmt->execute((array)$user);
            $message = 'Good data!';
            return true;
        }else{
            $message = 'Bad data!';
            return false;
            $this->view('Register/SignUp',['message'=>$message]);
        }
    }
        
    public function insertCard($user){
		$message = 'Please enter user data.';
		$card = $this->model('PaymentCard');
		$DBConn = new DBConnection();

        $card->payment_method = $_POST['paymentMethod'];
        $card->customer_id = $user;
        $card->cc_number = $_POST['cardNumber'];
        $card->cc_name = $_POST['cardName'];
        $card->cc_expiration_date = $_POST['expDate'];

        if($card->isValid()){
            $stmt = $DBConn->connection->prepare('INSERT INTO payment_card(payment_method, customer_id, cc_number, cc_name, cc_expiration_date) VALUES (:payment_method, :customer_id, :cc_number, :cc_name, :cc_expiration_date)');
            $stmt->execute((array)$card);
            $message = 'Good data!';
            return header('location:/mvc/public/Home');

        }else{
            $message = 'Bad data!';
            return header('location:/mvc/public/Home');
            $this->view('Register/SignUp',['message'=>$message]);
        }
    }
        
    public function getUser() {
        $email = $_POST['email'];
        $model = $this->model("User");
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT user_id FROM user WHERE email = '$email'");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'User');
        $data = [];
        while($get = $stmt->fetch()) {
            $data[] = $get;
        }
        $user = $data[0]->user_id;
        return $user;
    }
}
?>