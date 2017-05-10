<?php

class PaymentCard
{
	public $payment_method;
	public $customer_id;
	public $cc_number;
	public $cc_name;
	public $cc_expiration_date;

	//small validation rules for this model
	public function isValid(){
        $payment_method = $this->payment_method != '';
		$cc_number = $this->cc_number != '';
		$cc_name = $this->cc_name != '';
		$cc_expiration_date = $this->cc_expiration_date != '';
		
		return $payment_method && $cc_number && $cc_name && $cc_expiration_date;
	}

}

?>