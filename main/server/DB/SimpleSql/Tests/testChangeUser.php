<?php
    require_once 'libBD.php';

	//CreateTablesToBD();

    $user = array ( 
		'surname' => 'Пупкин',
		'id' => 27,
    );
   
    changeUser($user);
?>