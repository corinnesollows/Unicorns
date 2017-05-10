<?php

class Message
{
	public $message_desc;
	public $message_date;

	//small validation rules for this model
	public function isValid(){
		$message_desc = $this->message_desc != '';	
		$message_date = $this->message_date != '';
		return $message_desc && $message_date;
	}
}
?>