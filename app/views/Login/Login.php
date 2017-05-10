<html>
<head>
	<title>Pocket Unicorns</title>
    <link href="/mvc/public/css/SignIn.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
	global $errorMessage;
?>
<div id="main">
<div id="signUpBox">
Not a member?
<form id="signUpButton" method="post" action="/mvc/public/UserRegistration/signUp">
<input type="submit" id="signUp" name="signUp" value="Sign Up" />
</form>
</div>
<div id="loginBox">
<h1>Pocket Unicorns</h1>
<h2>Because Unicorns. Pocket-sized.</h2>
<?php echo $errorMessage; ?>
<form id="loginForm" method="post" action="/mvc/public/Home/validate">
    	<label for="email">Email Address</label>
        <input type="text" id="email" name="email" />
        <label for="password">Password</label>
        <input type="password" id="password" name="password" />
        <input type="submit" id="login" name="login" value="Log In" />
</form>
    </div>
</div>
</body>
</html>