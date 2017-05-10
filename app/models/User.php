<?php

class User
{
	public $fname;
	public $lname;
	public $email;
	public $password;
	public $user_type;
	public $address;
	public $city;
	public $province;
	public $postal_code;
	public $phone_number;

	//small validation rules for this model
	public function isValid(){
		$fname = $this->fname != '';
		$lname = $this->lname != '';
		$email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
		$password = $this->lname != '';
		$user_type = $this->user_type != '';
		$address = $this->address != '';
		$city = $this->city != '';
		$province = $this->province != '';
		$postal_code = $this->postal_code != '';
		$phone_number = $this->phone_number != '';
		
		return $fname && $lname && $email && $password && $user_type && $address && $city && $province && $postal_code && $phone_number;
	}
}

?>