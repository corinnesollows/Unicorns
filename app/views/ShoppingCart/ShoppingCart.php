<html>

<head>
    <title>Shopping Cart</title>
</head>

<body>
    <link href="/mvc/public/css/Stable.css" rel="stylesheet" type="text/css" />
    <?php
        include '/../Header/Header.php';
        $total = 0;
    ?>
    <table>
        <?php
            $cart = $data['array'];
            if(empty($cart))
                echo "<div id='emptyCartMessage' align='center'>Your shopping cart is empty.</div>";
            else {
                $total = $data['total'];
                echo "<table frame='box' cellspacing='25px' class='bigForm'><tr>
                    <th>Article</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Delete</th>
                </tr>";
                for($i = 0; $i < count($data['array']); $i++) {
                    echo "<tr>
                        <td>".$cart[$i++]."</td>
                        <td>".$cart[$i++]."</td>
                        <td>".$cart[$i++]."</td>
                        <td><form method='post' action='/mvc/public/ShoppingCart/updateCart'>
                                <input type='hidden' name='currentQuantity' value='".$cart[$i++]."'/>
                                <input type='hidden' name='id' value='".$cart[$i]."'/>
                                <select name='newQuantity'>";
                                for ($j = 0; $j <= ShoppingCart::getQuantity($cart[$i])+$cart[$i-1]; $j++) {
                                    if($cart[$i-1] == $j)
                                        echo "<option value='$j' selected>$j</option>";
                                    else
                                        echo "<option value='$j'>$j</option>";
                                }      
                                echo "</select>
                                <input type='submit' name='action' value='Update'/>
                            </form>
                        </td>                        
                        <td>
                            <form method='post' action='/mvc/public/ShoppingCart/delete'>
                                <input type='hidden' name='id' value='$cart[$i]' />
                                <input type='submit' name='action' value='Delete' />
                            </form>   
                        </td>
                    </tr>";
                }
                echo "<tr><td><div id='total'>Total: \$$total</div></td></tr>";
            }
        ?>
        <tr>
            <td>
                <div id='checkoutBox'>
                    <form method='post' action='/mvc/public/Checkout/checkoutPage'>
                        <input type='hidden' name='total' value='<?php echo $total; ?>' />
                        <input type='submit' name='action' value='Checkout' />
                    </form>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>