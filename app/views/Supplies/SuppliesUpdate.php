<html>

<head>
    <title>Stable</title>
    <link href="/mvc/public/css/Stable.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include '/../Header/Header.php';
        $item = $data['item'];
        $quantity = SuppliesUpdate::getItemQuantity();
		//form for admin to update an item in the item table
        echo"<table frame='box' cellspacing='25px' class='bigForm'>
            <form method='post' action='/mvc/public/SuppliesUpdate/update'>
                <input type='hidden' name='item_id' value='$item->item_id' required/>
                <tr><td><label for='name'>Name: </label></td>
                <td><input type='text' name='item_name' value='$item->item_name' required/>
                </tr></td>
                <tr><td><label for='gender'>Color: </label></td>
                <td><input type='text' name='item_color' value='$item->item_color'/>
                </tr></td>
                <tr><td><label for='age'>Price: </label></td>
               <td> <input type='text' name='item_price' value='$item->item_price' pattern='\d+(\.\d{2})?' required/>
                </tr></td>
                <tr><td><label for='color'>Type: </label></td>
                <td><input type='text' name='item_type' value='$item->item_type' required/>
                </tr></td>
                <tr><td><label for='quantity'>Quantity:</label></td>
                <td><input type='number' name='quantity' value='$quantity' required/>
                </tr></td>
                <tr><td><input type='submit' name='action' value='Update Item' /></tr></td>
            </form>
        </table>";
    ?>
</body>

</html>