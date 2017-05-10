<html>
<head><title>Previous Orders</title>
     <link href="/mvc/public/css/PreviousOrders.css" rel="stylesheet" type="text/css"/>
</head>
<?//= $data['message'] ?>
<body>
<table frame="box" cellspacing="25px">
<tr><th>Date</th><th>Payment Method</th><th>Total</th></tr>
<?php
	include '/../Header/Header.php'; 

	foreach($data['Order'] as $order)
		echo "<tr><td>$order->pdate</td><td>$order->payment_method</td>
		<td>\$$order->total</td></tr>";
?>
</table>
</body>
</html>