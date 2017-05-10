<?php
class StableUpdate extends Controller {
	
	//fills table with selected unicorn's current information
    public function StableUpdatePage() { 
		$u = $this->model("Unicorn");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT u_id, u_name, u_gender, u_age, u_breed_id, u_color, u_fee FROM Unicorn WHERE u_id = $_POST[unicornId]");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Unicorn');
		$unicorn = [];
		while($record = $stmt->fetch()){
			$unicorn[] = $record;
		}
        $this->view('Stable/StableUpdate', ['unicorn' => $unicorn[0]]);        
    }
    
	//gets the unicorns breed name with the id
	function getBreed($breed) {
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT breed_name FROM breed WHERE breed_id = '$breed'");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Breed');
        $data = $stmt->fetch();
        if(empty($data))
            return "";
        else
             return $data[0];
	}

	//when breed is selected from drop down it gets the breed_name with the breed_id from breeds table
	function getBreedId($breed) {
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT breed_id FROM breed WHERE breed_name = '$breed'");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Breed');
        $data = $stmt->fetch();
        if(empty($data))
            return "";
        else
             return $data[0];
	}
    
	//updates the unicorn table with what the user entered into the table
    public function update() { 
		$u = $this->model("Unicorn");
		$DBConn = new DBConnection();
        $breed = StableUpdate::getBreedId($_POST['breed']);
        $stmt = $DBConn->connection->prepare("UPDATE unicorn
                                              SET u_name = '$_POST[name]',
                                                  u_gender = '$_POST[gender]',
                                                  u_age = $_POST[age],
                                                  u_breed_id = $breed,
                                                  u_color = '$_POST[color]',
                                                  u_fee = $_POST[fee]
                                                  WHERE u_id = $_POST[id]");
        $stmt->execute();
        header('Location: /mvc/public/Stable/theStable');
    }
}
?>