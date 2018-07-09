<?php
	require_once 'BasePoint.php';
	

	class TableUsers
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Users'; 
			$this->openConnect = $openConnect;
			
			if ($db === false){
				if($this->openConnect === 0)
					$this->db = new OneClickMyDB($openConnect);	
			} else {
				$this->db = new OneClickMyDB($openConnect,$db);
			}
		}
		function connect(){
        	if ($this->openConnect === 1) {
        		$this->db = new OneClickMyDB($this->openConnect);
        	}
        }
		function close(){
			if ($this->openConnect === 1) {
				unset($this->db);
        	}
        }

        function GetIndex($mas,$value){
	        for ($i=0; $i < count($mas); $i++) { 
	            if($value === $mas[$i]) {
	                return $i;
	            }
	        }
	        return null;
	    }
		
		/*
			Редактировать колонки
		*/
		function create(){
			$this->connect();
		
			$Cols = array ( 
		        array  ( 'name' => 'id', 'type' => 10000, 'ref' => 0),
		        array  ( 'name' => 'name', 'type' => 14000, 'length' => 32, 'ref' => 0),
		    	array  ( 'name' => 'surname', 'type' => 14000, 'length' => 32, 'ref' => 0),
		    	array  ( 'name' => 'gender', 'type' => 14000, 'length' => 2, 'ref' => 0),
		    	array  ( 'name' => 'birthday', 'type' => 13000, 'ref' => 0),
		    	array  ( 'name' => 'login', 'type' => 14110, 'length' => 20, 'ref' => 0),
		    	array  ( 'name' => 'password', 'type' => 14100, 'length' => 32, 'ref' => 0),
		    	array  ( 'name' => 'email', 'type' => 14110, 'length' => 32, 'ref' => 0),
		    	array  ( 'name' => 'last_time_visit', 'type' => 12100, 'ref' => 0),
		    	array  ( 'name' => 'number_Lessons_learned', 'type' => 11100, 'uns' => 0, 'ref' => 0),
		    	array  ( 'name' => 'number_examples_learned_to_last_lesson', 'type' => 11100, 'uns' => 0, 'ref' => 0),
		    	array  ( 'name' => 'first_number_words_to_minutes', 'type' => 11000, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'current_number_words_to_minutes', 'type' => 11000, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'tmp_data', 'type' => 15000, 'length' => 1000, 'ref' => 0),
		    	array  ( 'name' => 'id_city', 'type' => 11000, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Cities',
                                  	'typeDelete' => 2,
                                  	'typeUpdate' => 1
		    						),
		    	array  ( 'name' => 'id_avatar', 'type' => 11000, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Avatars',
                                  	'typeDelete' => 2,
                                  	'typeUpdate' => 1
		    						)

		    );  	

		    $flag = $this->db->create($this->NameTable,$Cols);
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";

				else echo $flag;
			*/
		}

		//вызывать getId внутри addUser, после определения error
		function addUser($user){
			$this->connect();
		
			$date = date('Y-m-d h:i:s',time());

			$Cols_Values = array (
		        array  ( 'name' => 'name', 'value' => $user['name']),
		    	array  ( 'name' => 'surname', 'value' => $user['surname']),
		    	array  ( 'name' => 'login', 'value' => $user['login']),
		    	array  ( 'name' => 'password', 'value' => $user['password']),
		    	array  ( 'name' => 'email', 'value' => $user['email']),
		    	array  ( 'name' => 'last_time_visit', 'value' => $date),
		    );

		    $flag = $this->db->setString($this->NameTable,$Cols_Values);
		 	if($flag !== 0) {
		 		$flag2 = $this->db->getSingleString($this->NameTable, 'id', $id, 'email', $email);
		    	//$id = $id[0];
 				if($flag2 === 0) {
 					$flag["code_error"] = -1;
 					$flag["reason"] = "email";
 				} else {
 					$flag["code_error"] = 500;
 					$flag["reason"] = "server";
 				}
		 	}
		 	$this->close();
		 	return $flag;
		}

		function changeUser($user){
			$this->connect();
		

			$date = date('Y-m-d h:i:s',time());

 			$Cols_Values[0] = array  ( 'name' => 'last_time_visit', 'value' => $date);

			if(isset($user['name'])){
				$val = $user['name']; 
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'name', 'value' => $val);
			}
			
			if(isset($user['surname'])){ 
				$val = $user['surname']; 
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'surname', 'value' => $val);
			}
			if(isset($user['login'])){ 
				$val = $user['login']; 
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'login', 'value' => $val);
			}
			if(isset($user['password'])){ 
				$val = $user['password']; 
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'password', 'value' => $val);
			}
			if(isset($user['email'])) { 
				$val = $user['email']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'email', 'value' => $val);
			}
			if(isset($user['birthday'])) { 
				$val = $user['birthday']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'birthday', 'value' => $val);
			}
			if(isset($user['gender'])) { 
				$val = $user['gender']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'gender', 'value' => $val);
			}
			if(isset($user['id_city'])) { 
				$val = $user['id_city']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'id_city', 'value' => $val);
			}
			if(isset($user['id_avatar'])) { 
				$val = $user['id_avatar']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'id_avatar', 'value' => $val);
			}
			if(isset($user['id_avatar'])) { 
				$val = $user['id_avatar']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'id_avatar', 'value' => $val);
			}
			if(isset($user['Lessons_learned'])) { 
				$val = $user['Lessons']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'number_Lessons_learned', 'value' => $val);
			}
			if(isset($user['last_example'])) { 
				$val = $user['last_example']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'number_examples_learned_to_last_lesson', 'value' => $val);
			}
		    if(isset($user['first_number_words_to_minutes'])) { 
				$val = $user['first_number_words_to_minutes']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'first_number_words_to_minutes', 'value' => $val);
			}
			if(isset($user['current_number_words_to_minutes'])) { 
				$val = $user['current_number_words_to_minutes']; 	
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => 'current_number_words_to_minutes', 'value' => $val);
			}
		    

		    $flag = $this->db->updateString($this->NameTable, $Cols_Values, 'id', $user['id']);
		 	$this->close();
		 	return $flag;
		}

		function getId($email,&$id){
			$this->connect();
		
		    $flag = $this->db->getSingleString($this->NameTable, 'id', $id, 'email', $email);
		    $id = $id[0];
 		 	$this->close();
		 	return $flag;
		}


		//May be optimize
		function getUser(&$user,$id){
			$this->connect();
			
		    $flag = $this->db->getAllFromString($this->NameTable, $Cols_Values, 'id', $id);
		 
			/*  $user['name'] = $Cols_Values['name']; 
			$user['surname'] = $Cols_Values['surname']; 
			$user['login'] = $Cols_Values['login']; 
			$user['email'] = $Cols_Values['email']; 
			$user['birthday'] = $Cols_Values['birthday']; 
			$user['gender'] = $Cols_Values['email']; 
			$user['id_city'] = $Cols_Values['id_city']; 
			$user['last_time_visit'] = $Cols_Values['last_time_visit']; 
			$user['number_Lessons_learned'] = $Cols_Values['number_Lessons_learned']; 
			$user['number_examples_learned_to_last_lesson'] = $Cols_Values['number_examples_learned_to_last_lesson']; 
			$user['id_avatar'] = $Cols_Values['id_avatar']; */
			if(isset($user['name']) && ($user['name'])){
				$user['name'] = $Cols_Values['name']; 
			}	
			if(isset($user['surname']) && ($user['surname'])){ 
				$user['surname'] = $Cols_Values['surname']; 
			}
			if(isset($user['login']) && ($user['login'])){ 
				$user['login'] = $Cols_Values['login']; 
			}
			if(isset($user['email']) && ($user['email'])) { 
				$user['email'] = $Cols_Values['email']; 
			}
			if(isset($user['birthday']) && ($user['birthday'])) { 
				$user['birthday'] = $Cols_Values['birthday']; 
			}
			if(isset($user['gender']) && ($user['gender'])) { 
				$user['gender'] = $Cols_Values['gender']; 
			}
			if(isset($user['id_city']) && ($user['id_city'])) { 
				$user['id_city'] = $Cols_Values['id_city']; 
			}
			if(isset($user['id_avatar']) && ($user['id_avatar'])) { 
				$user['id_avatar'] = $Cols_Values['id_avatar']; 
			}
			if(isset($user['Lessons_learned']) && ($user['Lessons_learned'])) { 
				$user['Lessons_learned'] = $Cols_Values['number_Lessons_learned']; 
			}
			if(isset($user['last_example']) && ($user['last_example'])) { 
				$user['last_example'] = $Cols_Values['number_examples_learned_to_last_lesson']; 
			}
			if(isset($user['last_time_visit']) && ($user['last_time_visit'])) { 
				$user['last_time_visit'] = $Cols_Values['last_time_visit']; 
			}
			if(isset($user['first_number_words_to_minutes']) && ($user['first_number_words_to_minutes'])) { 
				$user['first_number_words_to_minutes'] = $Cols_Values['first_number_words_to_minutes']; 
			}
			if(isset($user['current_number_words_to_minutes']) && ($user['current_number_words_to_minutes'])) { 
				$user['current_number_words_to_minutes'] = $Cols_Values['current_number_words_to_minutes']; 
			}

			if(isset($user['password']) && ($user['password'])) { 
				$user['password'] = 'Фиг вам'; 
			}
		 	$this->close();
		 	return $flag;
		}

		function checkPass($user,&$valid){
			$this->connect();
			
		    $flag = $this->db->getSingleString($this->NameTable, 'password', $password, 'email', $user['email']);
		    
		    if($flag === 0) {
		    	$error["code_error"] = 0;	
		    	$pass = $password[0];
				$valid = $user['password'] === $pass;
			} else {
				if($flag === 2)  {
					$error["code_error"] = -1;
					$error["reason"] = "client";
					$valid = false;	
				} else {
					$error["code_error"] = 500;
					$error["reason"] = "server";			
				}
			}

		 	$this->close();
		 	return $error; 
		}

		function delete(){
			$this->connect();	
		    $flag = $this->db->deleteTable($this->NameTable);
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Удалеение таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}
	}
?>