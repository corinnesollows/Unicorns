<html>

<head>
    <title>Checkout</title>
</head>

<body>
    <link href="/mvc/public/css/Checkout.css" rel="stylesheet" type="text/css" />
    <?php
        include '/../Header/Header.php';
        $user = Checkout::getUser();
        $card = Checkout::getCard();
    ?>
    <div id="main">
    <h1>Checkout</h1>
    <div id="left">
    <div id="shipping" class="info">
        <h2>Shipping Information</h2></td>
        <table frame='box' cellspacing='20px' align="center">
            <tr>
                <td>First Name:</td>
                <td><?php echo $user->fname ?></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><?php echo $user->lname ?></td>
            </tr>
            <tr>
                <td>Email address:</td>
                <td><?php echo $user->email ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?php echo $user->address ?></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><?php echo $user->city ?></td>
            </tr>
            <tr>
                <td>Province:</td>
                <td><?php echo $user->province ?></td>
            </tr>
            <tr>
                <td>Postal Code:</td>
                <td><?php echo $user->postal_code ?></td>
            </tr>
            <tr>
                <td>Phone Number:</td>
                <td><?php echo $user->phone_number ?></td>
            </tr>
        </table>
    </div>
    
    <div id="credit" class="info">
        <h2>Credit Card Information</h2>
        <table frame='box' cellspacing='20px' align="center" class="addForm">
            <tr>
                <td>Payment Method:</td>
                <td><?php echo $card->payment_method ?></td>
            </tr>
            <tr>
                <td>Credit Card Number:</td>
                <td><?php echo $card->cc_number ?></td>
            </tr>
            <tr>
                <td>Cardholder's Name:</td>
                <td><?php echo $card->cc_name ?></td>
            </tr>
            <tr>
                <td>Expiration Date:</td>
                <td><?php echo $card->cc_expiration_date ?></td>
            </tr>
        </table>
    </div>
    </div>
    <div id="right">
    <div id="orders">
        <h2>Orders</h2>
        <table frame='box' cellspacing='20px' class='addForm'>
            <tr>
                <th>Article</th>
                <th>Color</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php
                $cart = $data['array'];
                for($i = 0; $i < count($data['array']); $i++)
                    echo "<tr>
                        <td>".$cart[$i++]."</td>
                        <td>".$cart[$i++]."</td>
                        <td>".$cart[$i++]."</td>
                        <td>".$cart[$i++]."</td>
                    </tr>";
                echo "<tr><td><div id='total'>Total: \$$_POST[total]</div></td></tr>";
            ?>
            <br>           
        </table>
            <form id="confirm" name="confirm" method="post"  class="formButton" action="/mvc/public/Checkout/transaction">
        <input type="hidden" name="total" value='<?php echo "$_POST[total]"; ?>'/>
        <input type="submit" id="confirm" name="confirm" class="mainButton" value="Confirm" />
                </form> 
        <form id="confirm" name="confirm" method="post" class="formButton" action="/mvc/public/MyAccount/myAccountPage">
        <input type="submit" id="confirm" name="update" class="mainButton" value="Update Information" />
    </form>
    </div>
    </div>
</div>



</body>

</html>