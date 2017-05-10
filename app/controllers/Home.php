<?php

class Home extends Controller
{
	public $errorMessage = "";
	
	public function index($name = '')
	{
		$user = $this->model('User');
		$user->name = $name;
		
		$this->view('Login/Login', ['name' => $user->name]);
	}
    
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        return header("Location: /mvc/public/Home");
    }
	
	public function validate() {
        global $errorMessage;
		session_start();
	
		if(($_POST['email'] != "") && ($_POST['password'] != "")) {
            $u = $this->model("User");
			$email = $_POST['email'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$DBConn = new DBConnection();
			$stmt = $DBConn->connection->prepare("SELECT password, user_type FROM user WHERE email = '$email'");
			$stmt->execute();
			$stmt->setFetchMode (PDO::FETCH_CLASS , 'User');
            $data = $stmt->fetch();
			
			if(!empty($data) && password_verify($_POST['password'], $data->password)) {
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['userType'] = $data->user_type;
                $_SESSION['cart'] = [];
				return header("Location: /mvc/public/About/about");
            }		
			else
                $errorMessage = "Email and password do not match";
		}
		else
			$errorMessage = "Please fill both fields";
		return header("Location: /mvc/public/Home");
				
	}
}

?>