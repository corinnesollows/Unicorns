<?php

class MyAccount extends Controller{
	
    public $errorPassword2;
    
	public function myAccountPage() {
		$this->view('MyAccount/MyAccount');
	}
    
    public function getData($field) {
        $email = $_SESSION['email'];
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT $field FROM user WHERE email = '$email'");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'User');
        $data = $stmt->fetch();
        if(empty($data))
            return "holler";
        else
             return $data[0];
    }
    
	public function getCardData($field) {
		$id = MyAccount::getData("user_id");
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT $field FROM payment_card WHERE customer_id = $id");
		$stmt->execute();
		$stmt->setFetchMode (PDO::FETCH_CLASS , 'PaymentCard');
		$data = $stmt->fetch();
		if(empty($data))
			return "";
		else
			 return $data[0];
	}
	
    public function update() {
        global $errorEmail;
        global $errorPassword2;
        $u = $this->model("User");
        $DBConn = new DBConnection();
        if($_POST[newPassword] != "") {
            if($_POST['newPassword'] == $_POST['newPassword2']) {
                $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $stmt = $DBConn->connection->prepare("UPDATE user
                                                      SET fname = '$_POST[firstName]',
                                                          lname = '$_POST[lastName]',
                                                          email = '$_POST[email]',
                                                          password = '$password', 
                                                          address = '$_POST[address]',
                                                          city = '$_POST[city]',
                                                          province = '$_POST[province]',
                                                          postal_code = '$_POST[postalCode]',
                                                          phone_number = '$_POST[phoneNumber]'
                                                          WHERE user_id = $_POST[user_id]");
                $stmt->execute();
            }
            else
               $errorPassword2 = "Passwords must match!"; 
        }
        else {
            $stmt = $DBConn->connection->prepare("UPDATE user
                                                  SET fname = '$_POST[firstName]',
                                                      lname = '$_POST[lastName]',
                                                      email = '$_POST[email]',
                                                      address = '$_POST[address]',
                                                      city = '$_POST[city]',
                                                      province = '$_POST[province]',
                                                      postal_code = '$_POST[postalCode]',
                                                      phone_number = '$_POST[phoneNumber]'
                                                      WHERE user_id = $_POST[user_id]");
            $stmt->execute();
        }
		header('Location: /mvc/public/MyAccount/myAccountPage');
	}
	
	public function cardUpdate() { 
		$pm = $this->model("PaymentCard");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE payment_card
                                              SET payment_method = '$_POST[payment_method]',
											      cc_number = '$_POST[cc_number]',
                                                  cc_name = '$_POST[cc_name]',
                                                  cc_expiration_date = '$_POST[cc_expiration_date]'
												  WHERE customer_id = $_POST[user_id]");
        $stmt->execute();
        header('Location: /mvc/public/MyAccount/myAccountPage');
	}
}
?>