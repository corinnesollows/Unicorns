<?php
class Search extends Controller
{
   
    public function theSearch()
	{
        $unicorns = Search::searchUnicorn();
        $items = Search::searchItem();
		$items2 = Search::searchType();
		$unicorns2 = Search::searchColor();
				
		$this->view('Search/Search', ['unicorns' => $unicorns, 'items' => $items, 'unicorns2' => $unicorns2, 'items2' => $items2]);			
	}

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
    
    public function searchUnicorn() {
        $model = $this->model("Unicorn");
        $value = $_POST["searchName"];
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT * FROM unicorn INNER JOIN inventory ON inventory.unicorn_id = unicorn.u_id WHERE u_name = '$value' AND inventory_qoh > 0");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Unicorn');
        $unicorn = [];
        
        while($record = $stmt->fetch()){
			$unicorn[] = $record;
		}
        return $unicorn;
    }
	
	 public function searchColor() {
        $model = $this->model("Unicorn");
        $value = $_POST["searchName"];
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT * FROM unicorn INNER JOIN inventory ON inventory.unicorn_id = unicorn.u_id WHERE u_color = '$value' AND inventory_qoh > 0");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Unicorn');
        $unicorn = [];
        
        while($record = $stmt->fetch()){
			$unicorn[] = $record;
		}
        return $unicorn;
    }
	
	function getQuantity($item) {
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT inventory_qoh FROM inventory WHERE item_id = $item");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Inventory');
        $data = $stmt->fetch();
        if(empty($data))
            return "";
        else
             return $data[0];
	}    
    
    public function searchItem() {
        $model = $this->model("Item");
        $value = $_POST["searchName"];
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT * FROM item INNER JOIN inventory USING(item_id) WHERE item_name = '$value' AND inventory_qoh > 0");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
        $item = [];
        
        while($record = $stmt->fetch()){
			$item[] = $record;
		}
        return $item;        
    }
    
	public function searchType() {
        $model = $this->model("Item");
        $value = $_POST["searchName"];
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT * FROM item INNER JOIN inventory USING(item_id) WHERE item_type = '$value' AND inventory_qoh > 0");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
        $item = [];
        
        while($record = $stmt->fetch()){
			$item[] = $record;
		}
        return $item;        
    }
	
    public function getFromInventory($type) {
        $model = $this->model('Inventory');
        $DBConn = new DBConnection();
        $id = $_POST['id'];
		$stmt = $DBConn->connection->prepare("SELECT inventory_id FROM inventory WHERE $type = $id");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Inventory');
        $array = [];
		while($record = $stmt->fetch()){
			$array[] = $record;
		}
        $record = $stmt->fetch();
        return $array[0]->inventory_id;
    }
    
	public function addUnicornToCart() {
        if(isset($_POST['action']) && $_POST['action'] == 'Adopt') {
            if(!isset($_SESSION))
                session_start();
            $inventoryId = Search::getFromInventory('unicorn_id');
            Search::decrement($inventoryId);
            array_push($_SESSION['cart'], $inventoryId);
        }
        $this->view('/About/about', ['name' => $_POST['name']]);
	}   
    
	public function addItemToCart() {
        if(isset($_POST['action']) && $_POST['action'] == 'Add to Cart') {
            if(!isset($_SESSION))
                session_start();
            $inventoryId = Search::getFromInventory('item_id');
            Search::decrement($inventoryId);
            array_push($_SESSION['cart'], $inventoryId);
        }
        $this->view('/About/about', ['name' => $_POST['name']]);
	}
    
    function decrement($inventoryId) {
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE inventory
                                              SET inventory_qoh = inventory_qoh - 1
								                WHERE inventory_id = $inventoryId");
        $stmt->execute();        
    }
}
?>