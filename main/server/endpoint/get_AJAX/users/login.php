<?php
    require_once 'libBD.php';

	//CreateTablesToBD();
   
   	$user['email'] = $_POST['email'];
   	$user['password'] = $_POST['password'];

   	$result = addUser($user);
   	print_r($result);
?>