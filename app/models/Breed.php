<?php

class Breed
{
	public $breed_name;
	public $breed_desc;

	//small validation rules for this model
	public function isValid(){
		$breed_name = $this->breed_name != '';
		$breed_desc = $this->breed_desc != '';
		return breed_name && $breed_desc;
	}
}

?>