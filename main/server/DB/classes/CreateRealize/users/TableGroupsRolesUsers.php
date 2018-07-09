<?php
	require_once 'BasePoint.php';
	

	class TableGroupsRolesUsers
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Groups_Roles_Users'; 
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
		
		/*
			Редактировать колонки
		*/
		function create(){
			$this->connect();
		
			$Cols = array ( 
		        array  ( 'name' => 'id_group', 'type' => 11100, 'uns' => true, 'ref' => 1,
		        					'ColRef' => 'id',
                                  	'TableRef' => 'Table_Groups',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
                        ),
		        array  ( 'name' => 'id_user', 'type' => 11100, 'uns' => true, 'ref' => 1,
		        					'ColRef' => 'id',
                                  	'TableRef' => 'Table_Users',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		        array  ( 'name' => 'id_role_user', 'type' => 11100, 'uns' => true, 'ref' => 1,
		        					'ColRef' => 'id',
                                  	'TableRef' => 'Table_Roles_Users',
                                  	'typeDelete' => 0,
                                  	'typeUpdate' => 1
		    			),
		    );

		    $flag = $this->db->create($this->NameTable,$Cols);
		    
		    $Cols = array ( 
		        'name_key' => 'key_group_user_u',
		        'names' => array  ('id_group', 'id_user')
		    ); 
		 	if($flag === 0) 
		 		$flag = $this->db->addUniqueKey($this->NameTable,$Cols);

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";

				else echo $flag;
			*/
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