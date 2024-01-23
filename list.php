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
	
	// $num = $_POST['num'];

	$url = $GLOBALS['URLNAME']."/api/read.php";

	$data = array(

		"number" => '1',

	);
	// var_dump($data);
	$data_json = json_encode($data);
	$arr = post_function($url, $data_json);

	$data_array = json_decode($arr, TRUE);

	// var_dump($data_array);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pets</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<h1>Pets List</h1>
	
		<form action="add_pet_details.php" method="post">
		<button type="button" onclick="addPet()">
		Add Pet
		</button>
		</form>



<table>	

	<tr>
		<th><center>Number</center></th>
		<th><center>Pet Name</center></th>
		<th><center>Owner</center></th>
		<th><center>Species</center></th>
		<th><center>Sex</center></th>
		<th><center>Birth of Pet</center></th>
		<th><center>Death of Pet</center></th>
		<th><center>Edit</center></th>
		<th><center>Delete</center></th>
	</tr>

<?php  

foreach ($data_array['posts'] as $key) { ?>

<tr> 
	<td>
		<?=$key['num']; ?>
	</td>

	<td>
		<?=$key['name']; ?>
	</td>
	
	<td>
		<?=$key['owner']; ?>
	</td>
	
	<td>
		<?=$key['species']; ?>
	</td>
	
	<td>
		<?=$key['sex']; ?>
	</td>
	
	<td>
		<?=$key['birth']; ?>
	</td>

	<td>
		<?=$key['death']; ?>
	</td>

	<td>
		<button type="button"><a href="edit_pet_details.php?number=<?=$key['num'];?>">Edit</a></button>
		
	</td>

	<td>
		<button type="button"><a href="delete_pet_details.php?number=<?=$key['num'];?>">Delete</a></button>
		
	</td>

</tr>

	
<?php }   ?>
</table>











<script type="text/javascript">
	
	function addPet(){
		<?php $addLink = $GLOBALS['URLNAME']."/add_pet_details.php"; ?>
        window.alert('Want to Add Pet');
        window.location.href='<?=$addLink?>';
	}

	function editPet(){
		<?php $editLink = $GLOBALS['URLNAME']."/edit_pet_details.php"; ?>
		window.alert('Want to edit Pet');
		window.location.href='<?=$editLink?>';
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

