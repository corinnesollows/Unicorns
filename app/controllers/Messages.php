<?php
class Messages extends Controller
{
	//fills table with messages and dates from the message table
	function messages()
	{
		$error = "";
		$m = $this->model("Message");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT message_id, message_desc, message_date FROM Message");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Message');
		$message = [];
		while($record = $stmt->fetch()){
			$message[] = $record;
		}
        $this->view('Messages/Messages', ['Error' => $error, 'Message' => $message]);
	}

	// user can add a message to the database
	function addMessage()
	{
		$error = 'Please enter a Message.';
		$message = $this->model('Message');
		$DBConn = new DBConnection();
		if($_POST['message_desc'] != ""){
			$message->message_desc = $_POST['message_desc'];
			$message->message_date = date("Y-m-d");
		
			$stmt = $DBConn->connection->prepare('INSERT INTO message(message_desc, message_date) VALUES (:message_desc, :message_date)');
			$stmt->execute((array)$message);
			$error = 'Good data!';
			return header('location:/mvc/public/Messages/messages');
		}
	}

	//admin can delete inappropriate messages from the message table
	function deleteMessage()
	{
        if(isset($_POST['action']) && $_POST['action'] == 'Delete Message'){
			$DBConn = new DBConnection();
			$ID = $_POST['messageId'];
			$stmt = $DBConn->connection->prepare('DELETE FROM Message WHERE message_id = ?');
			$stmt->execute(array($ID));
			return header('location:/mvc/public/Messages/messages');
		}	
	}
}
?>