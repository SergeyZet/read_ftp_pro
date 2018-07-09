<?php
    require_once 'libBDAdmin.php';

	//CreateTablesToBD();


    $email = 'pupkin@vasia19.ru';
    $pass = 'awdawd123wqe';

    CreateTablesExamplesToBD();

   // checkPassUser($pass,$email,$valid);
    if(!$valid)
    	echo 'pass is invalid; ';
    echo 'valid = ' . $valid .";	"; 
?>