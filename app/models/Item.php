<?php

class Item
{
	public $item_name;
	public $item_color;
	public $item_type;
	public $item_price;

	//small validation rules for this model
	public function isValid(){
		$item_name = $this->item_name != '';
		$item_color = $this->item_color != '';
		$item_type = $this->item_type != '';
		$item_price = $this->item_price != '';
		return $item_name && $item_color && $item_type && $item_price;
	}

}

?>