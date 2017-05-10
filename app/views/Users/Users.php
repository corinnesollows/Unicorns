<html>

<head>
    <title>User List</title>
    <link href="/mvc/public/css/Users.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
            include '/../Header/Header.php';
        ?>
        <table frame="box" cellspacing="25px">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Phone Number</th>
            </tr>
            <?php			
			foreach($data['users'] as $user) {
				echo "<tr>
                    <td>$user->fname $user->lname</td>
                    <td>$user->email</td>
                    <td>$user->user_type</td>
                    <td>$user->address</td>
                    <td>$user->city</td>
					<td>$user->province</td>
                    <td>$user->postal_code</td>
                    <td>$user->phone_number</td>
                    <td>
                        <form method='post' action='/mvc/public/Users/delete' />
                            <input type='hidden' name='userId' value='$user->user_id' />
                            <input type='submit' class='delete' name='action' value='Delete' />
                        </form>
                    </td>
                </tr>";
			}
		?>
        </table>
</body>

</html>