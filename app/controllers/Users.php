<?php
class Users extends Controller
{	
	public function theUsers()
	{
        $model = $this->model('User');
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT * FROM user");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'User');
		$users = [];
		while($data = $stmt->fetch()) {
			$users[] = $data;
		}
        $this->view('Users/Users', ['users' => $users]);
	}

	public function delete()
	{
        if(isset($_POST['action']) && $_POST['action'] == 'Delete'){
			$DBConn = new DBConnection();
			$ID = $_POST['userId'];
			$stmt = $DBConn->connection->prepare('DELETE FROM user WHERE user_id = ?');
			$stmt->execute(array($ID));
            header('Location: /mvc/public/Users/theUsers');
		}	
	}
}
?>