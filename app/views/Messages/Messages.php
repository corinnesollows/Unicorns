<html>
<head><title>Messages</title>
</head>
<?= $data['Error'] ?>
<body>
<link href="/mvc/public/css/Messages.css" rel="stylesheet" type="text/css"/>
<?php 	include '/../Header/Header.php'; 
?>
<table frame="box" class='bigForm'>
<?php
	foreach($data['Message'] as $message)
	{	//fills with all annonymous messages and dates from message table
		echo "<tr><td>$message->message_date</td></tr>
		<tr><td>$message->message_desc</td></tr>
		<tr><td><HR><td></tr>
		<tr><td><form method='post' action='/mvc/public/Messages/deleteMessage'/>";
		//if user is admin can delete inappropriate messages
		 if($_SESSION['userType'] == 'admin')
		 {echo"<input type='hidden' name='messageId' value='$message->message_id' />
			<input type='submit' name='action' class='messageDeleter' value='Delete Message' />
		 </form></td></tr>";}
	}
?>
</table>
<br/><br/></br>
<!-- add table so user can add a message -->
<form class="addingMessage" action="/mvc/public/Messages/addMessage" method="POST">
<input type="text" name="message_desc" class="message_desc" placeholder="Write your message here....." required><br><br>
<input type="submit" value="Write a Message" class = "write">
</form>
</body>
</html>