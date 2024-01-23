<?php

include '../conn.php';

$json = file_get_contents('php://input');
$obj = json_decode($json);
header('Content-type: application/json');



$number = $obj->{'number'};


// $date = date('Y-m-d H:i:s');



if(isset($number)){

	$query = "DELETE FROM pet where num = '$number'";


    $stmt = $conn->prepare($query);
    // $stmt->bind_param("ssssss", $name, $owner, $species, $sex, $birth, $death);

    $result = $conn -> query($query);
    // $result = $stmt->execute();
	$postvalue['ResponseStatus']=200;
	$postvalue['responseMessage']="OK";
	$postvalue['result']=$result;
	// $postvalue['posts']=array(

	// 	"name" => $name,
	// 	"owner" => $owner,
	// 	"species" => $species,
	// 	"sex" => $sex,
	// 	"birth" => $birth,
	// 	"death" => $death
	// )
	echo json_encode($postvalue);
	$stmt->close();
}else{
	$postvalue['responseStatus']=400;
	$postvalue['responseMessage']="Bad Request";
	$postvalue['posts']=null;
	echo json_encode($postvalue);
}

?>