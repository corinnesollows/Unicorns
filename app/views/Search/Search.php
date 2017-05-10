<html>

<head>
    <link href="/mvc/public/css/Stable.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
        include '/../Header/Header.php'; 

        if(!empty($data['unicorns'])) {
            echo "<table frame='box' cellspacing='25px'>
                <tr>
                    <th>Unicorn</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Breed</th>
                    <th>Color</th>
                    <th>Adoption Fee</th>
                    <th>Adopt</th>
                </tr>";
				//fills the table with the searched unicorn data
            foreach($data['unicorns'] as $unicorn) {
                $breed = Search::getBreed($unicorn->u_breed_id);
                echo "<tr>
                    <td>$unicorn->u_name</td>
                    <td>$unicorn->u_gender</td>
                    <td>$unicorn->u_age</td>
                    <td>$breed</td>
                    <td>$unicorn->u_color</td>
                    <td>$$unicorn->u_fee</td>
                    <td>
                        <form method='post' action='/mvc/public/Search/addUnicornToCart'/>
                            <input type='hidden' name='name' value='$unicorn->u_name' />
                            <input type='hidden' name='id' value='$unicorn->u_id' />
                            <input type='submit' name='action' class='adopt' value='Adopt' />
                        </form>
                    </td>
                <tr>";
            }
            echo "</table>";
        }
		 if(!empty($data['unicorns2'])) {
            echo "<table frame='box' cellspacing='25px'>
                <tr>
                    <th>Unicorn</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Breed</th>
                    <th>Color</th>
                    <th>Adoption Fee</th>
                    <th>Adopt</th>
                </tr>";
		//fills the table with the searched color's unicorn data
            foreach($data['unicorns2'] as $unicorn2) {
                $breed = Search::getBreed($unicorn2->u_breed_id);
                echo "<tr>
                    <td>$unicorn2->u_name</td>
                    <td>$unicorn2->u_gender</td>
                    <td>$unicorn2->u_age</td>
                    <td>$breed</td>
                    <td>$unicorn2->u_color</td>
                    <td>$$unicorn2->u_fee</td>
                    <td>
                        <form method='post' action='/mvc/public/Search/addUnicornToCart'/>
                            <input type='hidden' name='name' value='$unicorn2->u_name' />
                            <input type='hidden' name='id' value='$unicorn2->u_id' />
                            <input type='submit' name='action' class='adopt' value='Adopt' />
                        </form>
                    </td>
                <tr>";
            }
		 echo "</table>";}
		//fills the table with the searched items data
        if(!empty($data['items'])) {
            echo "<table frame='box' cellspacing='25px' class='bigForm'>
                <tr>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Purchase</th>
                </tr>";

            foreach($data['items'] as $item) {
                $quantity = Search::getQuantity($item->item_id);
                echo "<tr>
                    <td>$item->item_name</td>
                    <td>$item->item_type</td>
                    <td>$item->item_color</td>
                    <td>\$$item->item_price</td>
                    <td>$quantity</td>
                    <td>
                        <form method='post' action='/mvc/public/Search/addItemToCart'/>
                            <input type='hidden' name='name' value='$item->item_name' />
                            <input type='hidden' name='id' value='$item->item_id' />
                            <input type='submit' name='action' class='buy' value='Add to Cart' />
                        </form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }
		//fills the table with the searched type item's data
        if(!empty($data['items2'])) {
            echo "<table frame='box' cellspacing='25px' class='bigForm'>
                <tr>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Purchase</th>
                </tr>";

            foreach($data['items2'] as $item2) {
                $quantity = Search::getQuantity($item2->item_id);
                echo "<tr>
                    <td>$item2->item_name</td>
                    <td>$item2->item_type</td>
                    <td>$item2->item_color</td>
                    <td>\$$item2->item_price</td>
                    <td>$quantity</td>
                    <td>
                        <form method='post' action='/mvc/public/Search/addItemToCart'/>
                            <input type='hidden' name='name' value='$item2->item_name' />
                            <input type='hidden' name='id' value='$item2->item_id' />
                            <input type='submit' name='action' class='buy' value='Add to Cart' />
                        </form>
                    </td>
                </tr>";
            }
            echo "</table>";
        }
    ?>
</body>

</html>