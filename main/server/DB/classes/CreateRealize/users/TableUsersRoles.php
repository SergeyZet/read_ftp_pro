﻿<?php
	require_once 'BasePoint.php';
	

	class TableUsersRoles
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Roles_Users'; 
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
		        array  ( 'name' => 'id', 'type' => 10000, 'ref' => 0),
		        array  ( 'name' => 'name', 'type' => 14100, 'length' => 32, 'ref' => 0),
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
		function addReferences(){
			$this->connect();
		
			
			$Cols = array ( 
		        array  ( 'name' => 'id_user', 'TableRef' => 'TableUsers', 'ColRef' => 'id', 'typeDelete' => 1, 'typeUpdate' => 1),
		    );  	   
		    
		    $flag = $this->db->addReferences($this->NameTable,$Cols);
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