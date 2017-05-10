<html>

<head>
    <title>Stable</title>
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
                return header('Location:/mvc/public/Stable/descOrder');
            }
            else if ($_POST['order'] == "asc"){
                return header('Location:/mvc/public/Stable/theStable');
            } 
			else if ($_POST['order'] == "price"){
                return header('Location:/mvc/public/Stable/priceOrder');
            }
        }
    }
    //display add unicorn if user is admin
    if($_SESSION['userType'] == 'admin') {
        echo "<table frame='box' cellspacing='25px' class='addForm'>
            <form method='post' action='/mvc/public/Stable/addUnicorn'>
                <tr><td>Unicorn Name: </td><td><input type='text' name='u_name' class='u_name' required></td></tr>
                <tr><td>Unicorn Gender: </td><td><select name='u_gender' class='u_gender'>
                <option value='F'>Female</option>
                <option value='M'>Male</option>
                </td></tr>
                <tr><td>Unicorn Age: </td><td><input type='number' name='u_age' class='u_age' pattern=;.{5,}'></td></tr>
                <tr><td>Unicorn Breed:</td><td><select name='breed_name'>";
		//fills breed drop down menu
        foreach(Stable::getBreeds() as $breed)
        {
            echo "<option value='$breed[breed_name]'>$breed[breed_name]</option>";
        }
        echo "</select></td></tr>
            <tr><td>Unicorn Color: </td><td><input type='text' name='u_color' class='u_color' required></td></tr>
            <tr><td>Unicorn Adoption Fee: </td><td><input type='number' name='u_fee' class='u_fee' pattern='\d+(\.\d{2})?' required></td></tr>
            <tr><td><input type='submit' name='action' class='add' value='Add Unicorn' /></td></tr>
            </form>
        </table>";
    }
    ?>
            <table frame="box" cellspacing="25px">
                <tr>
                    <th>Unicorn</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Breed</th>
                    <th>Color</th>
                    <th>Adoption Fee</th>
                    <th>Adopt</th>
                </tr>
                <?php
            foreach($data['Unicorn'] as $unicorn)
	{	//fills table with data from item table
                echo "<tr>
                <td>$unicorn->u_name</td>
                <td>$unicorn->u_gender</td>
    		    <td>$unicorn->u_age</td>
                <td>$unicorn->breed_name</td>
                <td>$unicorn->u_color</td>
                <td>\$$unicorn->u_fee</td>
    		    <td>
                    <form method='post' action='/mvc/public/Stable/addToCart'/>
                        <input type='hidden' name='unicornId' value='$unicorn->u_id' />
                        <input type='submit' name='action' class='adopt' value='Adopt' />
                    </form>
                </td>";
    		//delete and update unicorn options if admin
		 if(  $_SESSION['userType'] == 'admin')
		 {
             echo"<td>
                <form method='post' action='/mvc/public/Stable/deleteUnicorn'/>
                    <input type='hidden' name='unicornId' value='$unicorn->u_id' />
                    <input type='submit' name='action' class='delete' value='Delete Unicorn' />
                </form>
            </td>
            <td>
                <form method='post' action='/mvc/public/StableUpdate/stableUpdatePage'/>
                    <input type='hidden' name='unicornId' value='$unicorn->u_id' />
                    <input type='submit' name='action' class='update' value='Update Unicorn' />
                </form>
            </td></tr>";
         }
	}
?>
            </table>
</body>

</html>