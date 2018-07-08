<?php
    require_once '../../../DB/SimpleSql/Tables/All/CreateRealize/Base/SimpleSQLClass.php';

    $db = new MyDB();
    //$db->connect();
   
   	$user['email'] = $_POST['email'];
   	$user['password'] = $_POST['password'];

   	$result = addUser($user);
   	print_r($result);
?>