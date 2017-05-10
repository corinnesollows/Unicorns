<?php
class Supplies extends Controller
{	
public $error = "";
public $valid;	

	//displays all the items from the item table if not admin does not display with quan > 0
	public function theSupplies()
	{
        if(!isset($_SESSION))
            session_start();
		$s = $this->model("Item");
		$DBConn = new DBConnection();
        if($_SESSION['userType'] == 'admin')
            $stmt = $DBConn->connection->prepare("SELECT item.item_id, item.item_name, item.item_type, item.item_color, item.item_price, inventory.inventory_qoh FROM item INNER JOIN inventory ON inventory.item_id = item.item_id ORDER BY item_name");
        else
            $stmt = $DBConn->connection->prepare("SELECT item.item_id, item.item_name, item.item_type, item.item_color, item.item_price, inventory.inventory_qoh FROM item INNER JOIN inventory ON inventory.item_id = item.item_id WHERE inventory.inventory_qoh > 0 ORDER BY item_name");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
		$item = [];
		while($record = $stmt->fetch()){
			$item[] = $record;
		}
        $this->view('Supplies/Supplies', ['Item' => $item]);
	}

	//re-displays items anti-alpabetically
	public function descOrder()
	{
		$u = $this->model("Item");
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT item.item_id, item.item_name, item.item_type, item.item_color, item.item_price, inventory.inventory_qoh FROM item INNER JOIN inventory ON inventory.item_id = item.item_id ORDER BY item_name DESC");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
		$item = [];
		while($record = $stmt->fetch()){
			$item[] = $record;
		}
        $this->view('Supplies/Supplies', ['Item' => $item]);
	}
	
	//re-displays items from lowest price to highest
	public function priceOrder()
	{
		$u = $this->model("Item");
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT item.item_id, item.item_name, item.item_type, item.item_color, item.item_price, inventory.inventory_qoh FROM item INNER JOIN inventory ON inventory.item_id = item.item_id ORDER BY item_price");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
		$item = [];
		while($record = $stmt->fetch()){
			$item[] = $record;
		}
        $this->view('Supplies/Supplies', ['Item' => $item]);
	}
	
	//getting the quantity amount from the inventory table
    public function getFromInventory()
	{
        $model = $this->model('Inventory');
        $DBConn = new DBConnection();
        $id = $_POST['itemId'];
		$stmt = $DBConn->connection->prepare("SELECT inventory_id FROM inventory WHERE item_id = $id");
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
        if(isset($_POST['action']) && $_POST['action'] == 'Add to Cart') {
            if(!isset($_SESSION))
                session_start();
            $inventoryId = Supplies::getFromInventory();
            Supplies::decrement($inventoryId);
            array_push($_SESSION['cart'], $inventoryId);
        }
        header('location:/mvc/public/Supplies/theSupplies');
	}
	
	//delete item to item table(for admin)
	public function deleteItem()
	{
        if(isset($_POST['action']) && $_POST['action'] == 'Delete Item'){
			$DBConn = new DBConnection();
			$ID = $_POST['itemId'];
			$stmt = $DBConn->connection->prepare('DELETE FROM Item WHERE item_id = ?');
			$stmt->execute(array($ID));
			return header('location:/mvc/public/Supplies/theSupplies');
		}	
	}

	//add item to item table(for admin)
	function addItem()
	{
			$item = $this->model('Item');
			$DBConn = new DBConnection();
			$item->item_name = $_POST['item_name'];
			$item->item_type = $_POST['item_type'];
			$item->item_color = $_POST['item_color'];
			$item->item_price = $_POST['item_price'];

			$stmt = $DBConn->connection->prepare('INSERT INTO item(item_name, item_type, item_color, item_price) VALUES (:item_name, :item_type, :item_color, :item_price)');
			$stmt->execute((array)$item);
			$error = 'Good data!';

		header('location:/mvc/public/Supplies/theSupplies');
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