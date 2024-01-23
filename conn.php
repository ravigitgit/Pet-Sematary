<?php

session_start();

$server_name = $_SERVER['SERVER_NAME'];

// print_r($server_name);


$conn= mysqli_connect("localhost:3306","root","1234","ravi");


if($conn){
	// echo "db is connected";
	// print_r($con);
	// $con->close();
}else{
	// echo "db connection failed";
	// $con->connect_error;
}


