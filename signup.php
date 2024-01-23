<?php
include './conn.php';

if(isset($_POST['submit'])) {
	
	// retrieve form data
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO auth (username, password) VALUES('$username', '$hashedPassword')";
	$stmt = $conn->prepare($query);
	$result = $conn->query($query);

	// print_r($query);
	if($result) {
		// echo "Success";
		header("Location: login.php");
	}else{
		echo "Fail to SignUp";
	}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Signup</title>
</head>
<body>
	<h1>Signup</h1>
	<form  method="post" enctype="mutipart/form-data">
	<label>Username</label>
	<input type="text" name="user"></br>
	<label>Password</label>
	<input type="password" name="pass"></br>
	<input type="submit"  name="submit" value="Signup">
	</form>
</body>
</html>