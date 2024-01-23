<?php

include '../conn.php';

$json = file_get_contents('php://input');
$obj = json_decode($json);
header('Content-type: application/json');

$number = $obj->{'number'};
$name = $obj->{'name'};
$owner = $obj->{'owner'};
$species = $obj->{'species'};
$sex = $obj->{'sex'};
$birth = $obj->{'birth'};
$death = $obj->{'death'};

if(isset($number)){
	$query = "UPDATE pet SET name='$name',owner='$owner',species='$species',sex='$sex',birth='$birth',death='$death' WHERE num='$number'";

	$stmt = $conn->prepare($query);
	$result = $conn->query($query);
	// var_dump($query);

if($result){
	// $post = $result->fetch_all(MYSQLI_ASSOC);
	// var_dump($result);
	$postvalue['responseStatus']=200;
	$postvalue['responseMessage']='OK';
	echo json_encode($postvalue);
	// $stmt->close();
}else{
	$postvalue['responseStatus']=201;
	$postvalue['responseMessage']='NOT OK';
	echo json_encode($postvalue);
}
}else{

	$postvalue['responseStatus']=400;
	$postvalue['responseMessage']='Bad Request';
	$postvalue['posts']=null;
	echo json_encode($postvalue);
}