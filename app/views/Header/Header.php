<html>

<head>
    <link href="/mvc/public/css/Header.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="header">
        <a href="/mvc/public/About/about"><img src="/mvc/public/images/logo.jpg" id="logo" alt="Pocket Unicorns" /></a>
        <div id="upperRight">
            <a href="/mvc/public/Home/logout" id="logOut">Log Out</a>
            <form id="searchBar" method="post" action="/mvc/public/Search/theSearch">
                <input type="text" name="searchName" id="searchName" required />
                <input type="submit" id="search" value="Search" />
            </form>
        </div>
        <div class="help-tip">
            <p>Search for a Unicorn or Item name!</p>
        </div>
        <hr>
        <div id="navigation">
            <ul>
                <li><a href="/mvc/public/Stable/theStable">Unicorns</a></li>
                <li><a href="/mvc/public/Supplies/theSupplies">Pet Supplies</a></li>
                <li><a href="/mvc/public/Breeds/breeds">Breeds</a></li>
                <li><a href="/mvc/public/MyAccount/myAccountPage">My Account</a></li>
                <li><a href="/mvc/public/ShoppingCart/shoppingCartPage">My Cart</a></li>
                <li><a href="/mvc/public/Messages/messages">Messages</a></li>
                <?php
				    if(!isset($_SESSION))
                        session_start();
                    if($_SESSION['userType'] == 'admin')
                        echo "<li><a href='/mvc/public/Users/theUsers'>Users</a></li>";
                ?>
            </ul>
        </div>
        <hr>
    </div>
</body>

</html>