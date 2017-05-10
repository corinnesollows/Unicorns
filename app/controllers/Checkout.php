<?php
class Checkout extends Controller
{
    public $array = [];
    public $total = 0;
    
    public function checkoutPage() {
        global $array;
        global $total;
        if(!isset($_SESSION))
            session_start();
        $setCart = Checkout::getInventory();
        
        foreach($setCart as $inventory) {
            if($inventory->item_id != null) {
                $quantity = array_count_values($_SESSION['cart'])[$inventory->inventory_id]; 
                Checkout::getItem($inventory->item_id);
                $total += end($array) * $quantity;
                $array[] = $quantity;
                $array[] = $inventory->inventory_id;

            }
            else if($inventory->unicorn_id != null) {
                Checkout::getUnicorn($inventory->unicorn_id);
                $array[] = 1;
                $array[] = $inventory->inventory_id;
            }
        }        
        
        $this->view('Checkout/Checkout', ['array' => $array]);
    }
    public function getUser() {
        $email = $_SESSION['email'];
        $model = $this->model('User');
        $DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT * FROM user WHERE email = '$email'");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'User');
        $data = $stmt->fetch();
        if(empty($data))
            return "";
        else
             return $data;
    }

	public function getCard() {
		$id = Checkout::getUser()->user_id;
        $model = $this->model('PaymentCard');
		$DBConn = new DBConnection();
		$stmt = $DBConn->connection->prepare("SELECT * FROM payment_card WHERE customer_id = $id");
		$stmt->execute();
		$stmt->setFetchMode (PDO::FETCH_CLASS , 'PaymentCard');
		$data = $stmt->fetch();
		if(empty($data))
			return "";
		else
			 return $data;
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
        return $inventoryList;
        
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
    
    public function transaction() {
        session_start();
        $userId = Checkout::getUser()->user_id;
        $card = Checkout::getCard()->payment_id;
        $date = getdate()['year'].'-'.getdate()['mon'].'-'.getdate()['mday'];
		$DBConn = new DBConnection();
		$model = $this->model('Item');
		$stmt = $DBConn->connection->prepare("INSERT INTO orders(pdate, payment_id, total, user_id) VALUES ('$date',$card,$_POST[total],$userId)");
		$stmt->execute();
        $orderId = $DBConn->connection->lastInsertId();
        Checkout::insertOrderLine($orderId);
        header('Location: /mvc/public/Confirm/confirmPage');
    }
    
    public function insertOrderLine($order) {
        $DBConn = new DBConnection();
        foreach(Checkout::getInventory() as $inventory) {
            $quantity = array_count_values($_SESSION['cart'])[$inventory->inventory_id]; 
            $stmt = $DBConn->connection->prepare("INSERT INTO order_line(order_id, inventory_id, order_line_quantity) VALUES ($order,".$inventory->inventory_id.",$quantity)");
		$stmt->execute();
        }
    }    
}
?>