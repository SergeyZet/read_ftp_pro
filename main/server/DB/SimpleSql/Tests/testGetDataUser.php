<?php
    require_once 'libBD.php';

	//CreateTablesToBD();


    $user  = array(
     	'name' => true,
     	'surname' => true,
     	'login' => true,
     	'email' => true,
		'birthday' => true,
     	'gender' => true,
		'id_city' => true,
		'last_time_visit' => true,
		'Lessons_learned' => true,
		'last_example' => true,
		'id_avatar' => true,
    );
   


    getDataUser($user,27);

    echo 'name = ' . $user['name'] .";	";
	echo 'surname = ' . $user['surname'] .";	"; 
	echo 'login = ' . $user['login'] .";	"; 
	echo 'email = ' . $user['email'] .";	"; 
	echo 'birthday = ' . $user['birthday'] .";	"; 
	echo 'gender = ' . $user['gender'] .";	"; 
	echo 'id_city = ' . $user['id_city'] .";	"; 
	echo 'last_time_visit = ' . $user['last_time_visit'] .";	"; 
	echo 'number_Lessons_learned = ' . $user['Lessons_learned'] .";	"; 
	echo 'number_examples_learned_to_last_lesson = ' . $user['last_example'] .";	"; 
	echo 'id_avatar = ' . $user['id_avatar'] .";	"; 
?>