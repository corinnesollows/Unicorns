<html>

<head>
    <title>Supplies</title>
    <link href="/mvc/public/css/Stable.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include '/../Header/Header.php'; 
	//sort radio buttons					?>
        <form method="POST" action="" class="radioForm">
            <input type="radio" name="order" class='radio' value="asc">
            <label>Alphabetical</label>
            <br>
            <input type="radio" name="order" class='radio' value="desc">
            <label>Anti-Alphabetical</label>
            <br>
			<input type="radio" name="order" class='radio' value="price">
            <label>Price(Lowest to Highest)</label>
            <br>
            <input type='submit' name='action' class='change' value='Change Order' />
        </form>

        <?php
//when sort option clicked call functions
if(isset($_POST['action']) && $_POST['action'] == 'Change Order')
{
	if(isset($_POST['order']))
	{
		if ($_POST['order'] == "desc") { 
			return header('Location:/mvc/public/Supplies/descOrder');
			}
		else if ($_POST['order'] == "asc"){
			return header('Location:/mvc/public/Supplies/theSupplies');
			} 
		else if ($_POST['order'] == "price"){
			return header('Location:/mvc/public/Supplies/priceOrder');
		} 
	}
}
//if admin can add items
if($_SESSION['userType'] == 'admin')
{echo "<table frame='box' cellspacing='25px' class='addForm'><form method='post' action='/mvc/public/Supplies/addItem' />
<tr><td>Item Name: </td><td><input type='text' name='item_name' class='item_name' required></td></tr>
<tr><td>Item Type: </td><td><input type='text' name='item_type' class='item_type' required></td></tr>
<tr><td>Item Color: </td><td><input type='text' name='item_color' class='item_color'></td></tr>
<tr><td>Item Price:</td><td><input type='number' name='item_price' class='item_price' pattern='\d+(\.\d{2})?' required></td></tr>
<tr><td><input type='submit' name='action' class='add' value='Add Item' /></td></tr>
</form></table>";
} ?>
            <table frame="box" cellspacing="25px" class="addForm">
                <tr>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Purchase</th>
                </tr>

                <?php
	foreach($data['Item'] as $item)
	{	//fills table with data from item table
		echo "<tr><td>$item->item_name</td><td>$item->item_type</td>
		<td>$item->item_color</td><td>\$$item->item_price</td>
		<td>$item->inventory_qoh</td>";
		
		echo"<td><form method='post' action='/mvc/public/Supplies/addToCart'/>
		<input type='hidden' name='itemId' value='$item->item_id' />";
		if($item->inventory_qoh > 0)
		{
			echo"<input type='submit' name='action' class='buy' value='Add to Cart' /></form></td>";
		}
		 //displays delete and update button next to each item
		 if($_SESSION['userType'] == 'admin')
		 {echo"<td><form method='post' action='/mvc/public/Supplies/deleteItem'/>
			 <input type='hidden' name='itemId' value='$item->item_id' />
			 <input type='submit' name='action' class='delete' value='Delete Item' />
			 </form></td> 
			 <td><form method='post' action='/mvc/public/SuppliesUpdate/suppliesUpdatePage'/>
			 <input type='hidden' name='item_id' value='$item->item_id' />
			 <input type='submit' name='action' class='update' value='Update Item' />
			 </form></td></tr>";}
	}
?>
            </table>
</body>

</html>