<?php
class Inventory
{
    public $unicorn_id;
    public $item_id;
	public $inventory_qoh;

	//small validation rules for this model
	public function isValid(){
		$inventory_qoh = $this->inventory_qoh != '';
		return $inventory_qoh;
	}
}
?>