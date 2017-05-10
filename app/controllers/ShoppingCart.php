<?php
class ShoppingCart extends Controller
{
    public $total = 0;
    public $array = [];
    
	public function shoppingCartPage()
	{
        global $array;
        global $total;
        if(!isset($_SESSION))
            session_start();
        $setCart = ShoppingCart::getInventory();
        $this->view('ShoppingCart/ShoppingCart', ['array' => $array, 'total' => $total]);
	}
    
    public function getInventory() {
        global $array;
        global $total;
        $DBConn = new DBConnection();
        $model = $this->model('Inventory');
        $cart = implode(",", $_SESSION['cart']);
        if($cart == "")
            return;
        $stmt = $DBConn->connection->prepare("SELECT * FROM inventory WHERE inventory_id IN ($cart)");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Inventory');
		$inventory = [];
		while($record = $stmt->fetch()){
			$inventoryList[] = $record;
		}
        
        foreach($inventoryList as $inventory) {
            if($inventory->item_id != null) {
                $quantity = array_count_values($_SESSION['cart'])[$inventory->inventory_id]; 
                ShoppingCart::getItem($inventory->item_id);
                $total += end($array) * $quantity;
                $array[] = $quantity;
                $array[] = $inventory->inventory_id;

            }
            else if($inventory->unicorn_id != null) {
                ShoppingCart::getUnicorn($inventory->unicorn_id);
                $array[] = 1;
                $array[] = $inventory->inventory_id;
            }
        }
    }
    
    public function getItem($inventory) {
        global $array;
        $DBConn = new DBConnection();
        $model = $this->model('Item');
        $stmt = $DBConn->connection->prepare("SELECT * FROM item WHERE item_id = $inventory");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
		$record = $stmt->fetch();

        $array[] = $record->item_name;
        $array[] = $record->item_color;
        $array[] = $record->item_price;
    }

	public function getUnicorn($inventory) {
		global $array;
		global $total;
		$DBConn = new DBConnection();
		$model = $this->model('Item');
		$stmt = $DBConn->connection->prepare("SELECT * FROM unicorn WHERE u_id = $inventory");
		$stmt->execute();
		$stmt->setFetchMode (PDO::FETCH_CLASS , 'Item');
		$record = $stmt->fetch();

		$array[] = $record->u_name;
		$array[] = $record->u_color;
		$array[] = $record->u_fee;
		$total += $record->u_fee;
    }
    
    public function delete() {
        if(!isset($_SESSION))
            session_start();
        while(($key = array_search($_POST['id'], $_SESSION['cart'])) !== false) {
            ShoppingCart::increment($_POST['id']);
            unset($_SESSION['cart'][$key]);
        }
        header('Location: /mvc/public/ShoppingCart/shoppingCartPage');
    }    
    
    public function deleteFromCart() {
        if(!isset($_SESSION))
            session_start();
        if(($key = array_search($_POST['id'], $_SESSION['cart'])) !== false) {
            ShoppingCart::increment($_POST['id']);
            unset($_SESSION['cart'][$key]);
        }
        header('Location: /mvc/public/ShoppingCart/shoppingCartPage');
    }
    
    public function increment($inventoryId) {
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE inventory
                                              SET inventory_qoh = inventory_qoh + 1
								                WHERE inventory_id = $inventoryId");
        $stmt->execute();                
    }

	public function addToCart()
	{
        $id = $_POST['id'];
        if(!isset($_SESSION))
            session_start();
        ShoppingCart::decrement($id);
        array_push($_SESSION['cart'], $id);
	}    
    
    public function decrement($inventoryId) {
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("UPDATE inventory
                                              SET inventory_qoh = inventory_qoh - 1
								                WHERE inventory_id = $inventoryId");
        $stmt->execute();                
    }    
    
    public function updateCart() {
        $oldQty = $_POST['currentQuantity'];
        $newQty = $_POST['newQuantity'];
        if($oldQty > $newQty) {
            for($i = $oldQty; $i > $newQty; $i--) {
                ShoppingCart::deleteFromCart();
            }
        }
        else if($oldQty < $newQty) {
            for($i = $oldQty; $i < $newQty; $i++) {
                ShoppingCart::addToCart();
            }            
        }
        header('Location: /mvc/public/ShoppingCart/shoppingCartPage');
    }
    
    public function getQuantity($id) {
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT inventory_qoh FROM inventory WHERE inventory_id = $id");
        $stmt->execute();
		$record = $stmt->fetchAll();
        return $record[0][0];
    }
}
?>