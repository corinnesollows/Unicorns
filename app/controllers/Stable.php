<?php
class Stable extends Controller
{
	//displays all the unicorns from the unicorn table if not admin does not display with quan > 0
	public function theStable()
	{
		$u = $this->model("Unicorn");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT u_id, u_name, u_gender, u_age, breed_name, u_color, u_fee FROM Unicorn INNER JOIN breed ON u_breed_id = breed_id INNER JOIN inventory ON u_id = unicorn_id WHERE inventory_qoh > 0 ORDER BY u_name");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Unicorn');
		$unicorn = [];
		while($record = $stmt->fetch()){
			$unicorn[] = $record;
		}
        $this->view('Stable/Stable', ['Unicorn' => $unicorn]);
	}
	
	//re-displays items anti-alpabetically
	public function descOrder()
	{
		$u = $this->model("Unicorn");
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT u_id, u_name, u_gender, u_age, breed_name, u_color, u_fee FROM Unicorn INNER JOIN breed ON u_breed_id = breed_id ORDER BY u_name DESC");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Unicorn');
		$unicorn = [];
		while($record = $stmt->fetch()){
			$unicorn[] = $record;
		}
        $this->view('Stable/Stable', ['Unicorn' => $unicorn]);
	}
	
	//re-displays items from lowest price to highest
	public function priceOrder()
	{
		$u = $this->model("Unicorn");
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT u_id, u_name, u_gender, u_age, breed_name, u_color, u_fee FROM Unicorn INNER JOIN breed ON u_breed_id = breed_id ORDER BY u_fee");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Unicorn');
		$unicorn = [];
		while($record = $stmt->fetch()){
			$unicorn[] = $record;
		}
        $this->view('Stable/Stable', ['Unicorn' => $unicorn]);
	}
	
	//getting the breed_name amount from the breed table
    public function getBreeds() {
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT breed_name FROM breed");
        $stmt->execute();
		return $stmt->fetchAll();
    }
    
	//when adding a unicorn gets breed_id with the entered breed_name from the breed table
	function breedFinder($breed_name)
	{
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT breed_id FROM breed WHERE breed_name = '$breed_name'");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Breed');
        $data = $stmt->fetch();
        if(empty($data))
            return "";
        else
             return $data[0];
	}
    
	//getting the quantity amount from the inventory table
    public function getFromInventory() {
        $model = $this->model('Inventory');
        $DBConn = new DBConnection();
        $id = $_POST['unicornId'];
		$stmt = $DBConn->connection->prepare("SELECT inventory_id FROM inventory WHERE unicorn_id = $id");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Inventory');
        $array = [];
		while($record = $stmt->fetch()){
			$array[] = $record;
		}
        $record = $stmt->fetch();
        return $array[0]->inventory_id;
    }
	
	//add item to the shopping cart session
	public function addToCart()
	{
        if(isset($_POST['action']) && $_POST['action'] == 'Adopt') {
            if(!isset($_SESSION))
                session_start();
            $inventoryId = Stable::getFromInventory();
            Stable::decrement($inventoryId);
            array_push($_SESSION['cart'], $inventoryId);
        }
        header('location:/mvc/public/Stable/theStable');
	}
	
	//add unicorn to item unicorn(for admin)
	function addUnicorn()
	{
		$error = 'Please enter a Unicorn.';
		$unicorn = $this->model('Unicorn');
		$DBConn = new DBConnection();
		if($_POST['u_name'] != ""){
			$unicorn->u_name = $_POST['u_name'];
			$unicorn->u_gender = $_POST['u_gender'];
			$unicorn->u_age = $_POST['u_age'];
			$unicorn->u_color = $_POST['u_color'];
			$unicorn->u_fee = $_POST['u_fee'];
			$unicorn->u_breed_id = Stable::breedFinder($_POST['breed_name']);

			$stmt = $DBConn->connection->prepare('INSERT INTO unicorn(u_name, u_gender, u_age, u_breed_id, u_color, u_fee) VALUES (:u_name, :u_gender, :u_age, :u_breed_id, :u_color, :u_fee)');
			$stmt->execute((array)$unicorn);
			$error = 'Good data!';
			header('location:/mvc/public/Stable/theStable');
		}
	}
	
	//delete item to item table(for admin)
	function deleteUnicorn()
	{
        if(isset($_POST['action']) && $_POST['action'] == 'Delete Unicorn'){
			$DBConn = new DBConnection();
			$ID = $_POST['unicornId'];
			$stmt = $DBConn->connection->prepare('DELETE FROM Unicorn WHERE u_id = ?');
			$stmt->execute(array($ID));
			return header('location:/mvc/public/Stable/theStable');
		}	
	}
    
	//decrements the quantity on hand in inventory table
    function decrement($inventoryId) {
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE inventory
                                              SET inventory_qoh = inventory_qoh - 1
								                WHERE inventory_id = $inventoryId");
        $stmt->execute();        
    }
}
?>