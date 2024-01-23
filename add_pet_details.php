<?php
$GLOBALS['URLNAME'] = "http://localhost.ravi.in";

function post_function($url,$myvars)
{
	//print_r($url);exit;
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$res = curl_exec( $ch );
	return $res;

}

$url = $GLOBALS['URLNAME']."/list.php";

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$owner = $_POST['owner'];
	$species = $_POST['species'];
	$sex = $_POST['sex'];
	$birth = $_POST['birth'];
	$death = $_POST['death'];

	$url = $GLOBALS['URLNAME']."/api/create.php";

	$data = array(

		"name" => $name,
		"owner" => $owner,
		"species" => $species,
		"sex" => $sex,
		"birth" => $birth,
		"death" => $death
	);
	// var_dump($data);
	$data_json = json_encode($data);
	$arr = post_function($url, $data_json);

	$data_array = json_decode($arr, TRUE);
	// print_r($data_array);

	if($data_array['ResponseStatus'] == 200){
		echo "data submit succesfully";
		header('Location: list.php');
	}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pet</title>
</head>
<body>
	<h1>Enter your Pet Details</h1>

<form method="post" enctype="mutipart/form-data">
	<label for="name">Dog name:</label></br>
	<input type="text" name="name"  required></br>
	<label for="owner">Owner name:</label></br>
	<input type="text" name="owner"  required></br>
	<label for="species">Species:</label></br>
	<input type="text" name="species" required></br>
	<label for="sex">Sex:</label></br>
	<input type="text" name="sex" required></br>
	<label for="birth">Birth Date:</label></br>
	<input type="date" name="birth" required></br>
	<label for="death">Death Date:</label></br>
	<input type="date" name="death" required></br>

	<input type="submit" name="submit" value="Submit">
</form>

	
</body>
</html>