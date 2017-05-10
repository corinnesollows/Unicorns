<?php

class Unicorn
{
	public $u_name;
	public $u_gender;
	public $u_breed_id;
	public $u_age;
	public $u_color;
	public $u_fee;

	//small validation rules for this model
	public function isValid(){
		$u_name = $this->u_name != '';
		$u_gender = $this->u_gender != '';
		$u_breed_id = $this->u_breed_id != '';	
		$u_age = $this->u_age != '';
		$u_color = $this->u_color != '';
		$u_fee = $this->u_fee != '';
		return $u_name && $u_gender && $u_breed_id && $u_age && $u_color && $u_fee;
	}
}
?>