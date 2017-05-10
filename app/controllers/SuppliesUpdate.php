<?php
class SuppliesUpdate extends Controller {
	
	//fills table with selected items's current information
    public function SuppliesUpdatePage() { 
		$i = $this->model("Item");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT item_id, item_name, item_color, item_price, item_type FROM Item WHERE item_id = $_POST[item_id]");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
		$item = [];
		while($record = $stmt->fetch()){
			$item[] = $record;
		}
        $this->view('Supplies/SuppliesUpdate', ['item' => $item[0]]);        
    }
    
	//gets the items quantity on hand from the inventory table
    public function getItemQuantity() {
        $model = $this->model("Inventory");
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT inventory_qoh FROM inventory WHERE item_id = $_POST[item_id]");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Inventory');
		$item = [];
		while($record = $stmt->fetch()){
			$item[] = $record;
		}
        return $item[0] -> inventory_qoh;
    }
    
	//updates the inventory table with what the user entered into the table
	public function updateItemQuantity()
	{
		$u = $this->model("Inventory");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE inventory
                                              SET inventory_qoh = $_POST[quantity]
                                                  WHERE item_id = $_POST[item_id]");
        $stmt->execute();
	}

	//updates the item table with what the user entered into the table
    public function update() { 
		$i = $this->model("Item");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE item
                                              SET item_name = '$_POST[item_name]',
											      item_type = '$_POST[item_type]',
                                                  item_color = '$_POST[item_color]',
                                                  item_price = '$_POST[item_price]'
												  WHERE item_id = $_POST[item_id]");
        $stmt->execute();
        SuppliesUpdate::updateItemQuantity();
        header('Location: /mvc/public/Supplies/theSupplies');
    }
}
?>