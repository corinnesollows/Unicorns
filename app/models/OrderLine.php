<?php
class OrderLine
{
	public $order_line_quantity;

	//small validation rules for this model
	public function isValid(){
		$order_line_quantity = $this->order_line_quantity != '';
		return $order_line_quantity;
	}
}
?>