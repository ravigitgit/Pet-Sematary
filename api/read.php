<?php

include '../conn.php';

$json = file_get_contents('php://input');
$obj = json_decode($json);
header('Content-type: application/json');



$number = $obj->{'number'};



if(isset($number)){

	$query = "SELECT * FROM pet";


    $stmt = $conn->prepare($query);
    // $stmt->bind_param("ssssss", $number, $name, $owner, $species, $sex, $birth, $death);

    $result = $conn -> query($query);

 	$post = $result -> fetch_all(MYSQLI_ASSOC);


    // $result = $stmt->execute();
	$postvalue['ResponseStatus']=200;
	$postvalue['responseMessage']="OK";
	$postvalue['posts']=$post;

	echo json_encode($postvalue);
	$stmt->close();
}else{
	$postvalue['responseStatus']=400;
	$postvalue['responseMessage']="Bad Request";
	$postvalue['posts']=null;
	echo json_encode($postvalue);
}

?>