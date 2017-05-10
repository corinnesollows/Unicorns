<?php
class Breeds extends Controller
{
	//fills table with breeds from the breed table
	public function breeds()
	{
		$b = $this->model("Breed");
		$DBConn = new DBConnection();
         $stmt = $DBConn->connection->prepare("SELECT breed_id, breed_name, breed_desc FROM Breed");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Breed');
		$breed = [];
		while($record = $stmt->fetch()){
			$breed[] = $record;
		}
        $this->view('Breeds/Breeds', ['Breed' => $breed]);
	}
	
	//admin can add a breed to the breed table
	function addBreed()
	{
		$error = 'Please enter a Breed.';
		$breed = $this->model('Breed');
		$DBConn = new DBConnection();
		if($_POST['breed_desc'] != ""){
			$breed->breed_name = $_POST['breed_name'];
			$breed->breed_desc = $_POST['breed_desc'];
		
			$stmt = $DBConn->connection->prepare('INSERT INTO breed(breed_name, breed_desc) VALUES (:breed_name, :breed_desc)');
			$stmt->execute((array)$breed);
			$error = 'Good data!';
			return header('location:/mvc/public/Breeds/Breeds');
		}
	}
	// admin can delete a breed from the breed table
	function deleteBreed()
	{
        if(isset($_POST['action']) && $_POST['action'] == 'Delete Breed'){
			$DBConn = new DBConnection();
			$ID = $_POST['breedId'];
			$stmt = $DBConn->connection->prepare('DELETE FROM breed WHERE breed_id = ?');
			$stmt->execute(array($ID));
			return header('location:/mvc/public/Breeds/Breeds');
		}	
	}
}
?>