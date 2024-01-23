<?php

include './conn.php';
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




if(isset($_GET['number'])){
	$number = $_GET['number'];

	$query = "SELECT * FROM pet where num='$number'";
	$stmt = $conn->prepare($query);
	$result = $conn->query($query);

	$post = $result->fetch_all(MYSQLI_ASSOC);
	// print_r($post);

	$name = $post[0]['name'];
	$owner = $post[0]['owner'];
	$species = $post[0]['species'];
	$sex = $post[0]['sex'];
	$birth = $post[0]['birth'];
	$death = $post[0]['death'];
}

if(isset($_POST['submit']))
{
	$number = $_GET['number'];
	$name = $_POST['name'];
	$owner = $_POST['owner'];
	$species = $_POST['species'];
	$sex = $_POST['sex'];
	$birth = $_POST['birth'];
	$death = $_POST['death'];

	$url = $GLOBALS['URLNAME']."/api/update.php";

	$data = array(

		"number" => $number,
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

	$data_array = json_decode($arr, true);
	// var_dump($data_array);

	if($data_array['responseStatus'] === 200){
		echo "data submit succesfully";
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
	<h1>Edit your Pet Details</h1>

<form method="post" enctype="mutipart/form-data">
	<label for="name">Dog name:</label></br>
	<input type="text" name="name" value="<?= $name;?>" required></br>
	<label for="owner">Owner name:</label></br>
	<input type="text" name="owner" value="<?= $owner;?>" required></br>
	<label for="species">Species:</label></br>
	<input type="text" name="species" value="<?= $species;?>" required></br>
	<label for="sex">Sex:</label></br>
	<input type="text" name="sex" value="<?= $sex;?>" required></br>
	<label for="birth">Birth Date:</label></br>
	<input type="date" name="birth" value="<?= $birth;?>" required></br>
	<label for="death">Death Date:</label></br>
	<input type="date" name="death" value="<?= $death;?>" required></br>

	<input type="submit" name="submit" value="Submit">
	<button type="submit1" name="back" ><a href="list.php">Back</a></button>
</form>

	
</body>
</html>