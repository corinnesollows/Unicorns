<html>
<head><title>Stable</title>
     <link href="/mvc/public/css/Stable.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php include '/../Header/Header.php';
        $unicorn = $data['unicorn'];
        $breedName = StableUpdate::getBreed($unicorn->u_breed_id);
		//form for admin to update a unicorn in the unicorn table
        echo"<table frame='box' cellspacing='25px' class='bigForm'>
            <form method='post' action='/mvc/public/StableUpdate/update'>
                <input type='hidden' name='id' value='$unicorn->u_id' />
                <tr><td><label for='name'>Name</label></td>
                <td><input type='text' name='name' value='$unicorn->u_name' required/>
                </tr></td>
                <tr><td><label for='gender'>Gender</label></td>
                <td><input type='text' name='gender' value='$unicorn->u_gender' pattern='[A-Z]{1}' required/>
                 </tr></td>
                <tr><td><label for='age'>Age</label></td>
                <td><input type='number' name='age' value='$unicorn->u_age' pattern=;.{4,}' required/>
                 </tr></td>
                <tr><td><label for='breed'>Breed</label></td>
                <td><input type='text' name='breed' value='$breedName' required/>
                </tr></td>
                <tr><td><label for='color'>Color</label></td>
                <td><input type='text' name='color' value='$unicorn->u_color' required/>
                 </tr></td>
                <tr><td><label for='fee'>Adoption Fee</label></td>
                <td><input type='number' name='fee' value='$unicorn->u_fee' pattern='\d+(\.\d{2})?' required/>
                 </tr></td>
                 <tr><td><input type='submit' name='action' value='Update Unicorn' /> </tr></td>
            </form>
        </table>";
    ?>
</body>
</html>