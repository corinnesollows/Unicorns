<?php
class PreviousOrders extends Controller
{
	//fills table with past orders a user has made from the Orders table
	function previousorders()
	{
		$error = "";
		$m = $this->model("Order");
		$DBConn = new DBConnection();
        $stmt = $DBConn->connection->prepare("SELECT pdate, payment_method, total FROM Orders INNER JOIN payment_card ON payment_card.payment_id = orders.payment_id ORDER BY pdate");
        $stmt->execute();
        $stmt->setFetchMode (PDO::FETCH_CLASS , 'Order');
		$previous = [];
		while($record = $stmt->fetch()){
			$previous[] = $record;
		}
        $this->view('PreviousOrders/PreviousOrders', ['Error' => $error, 'Order' => $previous]);
	}
}
?>
