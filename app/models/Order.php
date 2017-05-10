<?php

class Order
{
	public $pdate;
	public $paymentm;
	public $total;

	//small validation rules for this model
	public function isValid(){
		$pdate = $this->pdate != '';
		$paymentm = $this->paymentm != '';
		$total = $this->total != '';
		return $pdate && $paymentm && $total;
	}
}
?>