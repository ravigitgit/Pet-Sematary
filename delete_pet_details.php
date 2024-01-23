<?php
// include './conn.php';

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

if(isset($_POST['delete'])) {
$number = $_GET['number'];


$url = $GLOBALS['URLNAME']."/api/delete.php";

	$data = array(

		"number" => $number
	);
	// var_dump($data);
	$data_json = json_encode($data);
	$arr = post_function($url, $data_json);

	$data_array = json_decode($arr, true);
	// var_dump($data_array);

	if($data_array['ResponseStatus'] === 200){
		echo "data deleted succesfully";
	}

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Pet Details</title>
</head>
<body>
	<h1>Do you really want to delete this Pet Details ?</h1>
	<form method="post" enctype="mutipart/form-data">
		<button type="submit" name="delete">Delete</button>
		<button type="submit1" name="back" ><a href="index.php">Back</a></button>
	</form>

</body>
<script type="text/javascript">
	function back() {
			<?php $url = $GLOBALS['URLNAME']."/index.php"; ?>
			window.alert("Do you want to go back ?");
			window.location.href = '<?=$url?>';
	}
</script>
</html>