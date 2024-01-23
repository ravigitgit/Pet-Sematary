<?php
include './conn.php';
$GLOBALS['URLNAME'] = "http://localhost.ravi.in";

if(isset($_POST['submit'])) {
	
	// retrieve form data
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$query = "SELECT password FROM auth WHERE username = '$username'";
	$stmt = $conn->prepare($query);
	$result = $conn->query($query);
	$post = $result->fetch_all(MYSQLI_ASSOC);

	// print_r($post);
  	foreach ($post as $key) {
  		if(password_verify($password, $key['password'])) {
		// echo "Success";
  			header("Location: index.php");
		}else{
			echo "Fail 2 login";
		}
  	}
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form  method="post" enctype="mutipart/form-data">
	<label>Username</label>
	<input type="text" name="user"></br>
	<label>Password</label>
	<input type="password" name="pass"></br>
	<input type="submit"  name="submit" value="Login">
	</form>
	<button type="button"  name="SignUp" onclick="signUp()">SignUp</button>
	
</body>
<script type="text/javascript">
	function signUp() {
		<?php $url=$GLOBALS['URLNAME']."/signup.php"; ?>
		window.alert('Want to Signup ?');
		window.location.href = '<?= $url ?>';
	}
</script>
</html>