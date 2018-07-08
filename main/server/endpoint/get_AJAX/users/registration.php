<?php
    require_once '../libs.php';

	//CreateTablesToBD();
    $user['status'] = $_POST['status'];
   	$user['name'] = $_POST['name'];
   	$user['surname'] = $_POST['surname'];
   	$user['email'] = $_POST['email'];
   	$user['password'] = $_POST['password'];

   	$result = addUser($user);
   	print_r($result);
   	/*{
		"id" : 		     (id  , -1	 , -1),
		"error_code" : (null, -1	 , 500),
		"reason" : 	   (null, "email", "server"),  
   	}*/
?>