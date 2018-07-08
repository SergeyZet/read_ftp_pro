<?php
    require_once '../libBD.php';

	//CreateTablesToBD();


    $user = array ( 
    	'name' => 'Вася',
		'surname' => 'Пупкин',
		'login' => 'super1',
		'email' => 'pupkin@vasis111.com',
		'password' => 'awdawd123wqe1',
    );
   
    echo "id = ". addUser($user);
?>