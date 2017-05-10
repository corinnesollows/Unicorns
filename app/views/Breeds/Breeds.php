<html>
<head><title>Breed Details</title>
     <link href="/mvc/public/css/Stable.css" rel="stylesheet" type="text/css"/>
</head>
<?//= $data['message'] ?>
<body>
<?php	include '/../Header/Header.php';
//if user is admin can add a breed to the breed table
if($_SESSION['userType'] == 'admin'){ 
echo"<table frame='box' cellspacing='25px'>
<form method='post' action='/mvc/public/Breeds/addBreed'/>
<tr><td>Breed Name: </td><td><input type='text' name='breed_name' class='breed_name' required></td></tr>
<tr><td>Breed Description: </td><td><input type='text' name='breed_desc' class='breed_desc' required></td></tr>
<tr><td><input type='submit' name='action' class='add' value='Add Breed' /></td></tr>
</form></table>";} ?>
<table frame="box" cellspacing="25px">
<tr><th>Breed</th><th>Description</th></tr>
<?php
	foreach($data['Breed'] as $breed)
	{	//fills table with breeds from the breed table
		echo "<tr><td>$breed->breed_name</td><td>$breed->breed_desc</td>
		<td><form method='post' action='/mvc/public/Breeds/deleteBreed'/>";
		if($_SESSION['userType'] == 'admin')
		 {echo"<input type='submit' name='action' class='delete' value='Delete Breed' />
	 		   <input type='hidden' name='breedId' value='$breed->breed_id' />
		 </form></td></tr>";}
	}
?>
</table>
</body>
</html>