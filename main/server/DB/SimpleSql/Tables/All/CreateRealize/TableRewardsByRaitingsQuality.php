<?php
	require_once 'BasePoint.php';
	

	class TableRewardsByRaitingsQuality
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Rewards_By_Raitings_Quality'; 
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
		        array  ( 'name' => 'id_type', 'type' => 11110, 'uns' => true, 'ref' => 1,
		        					'ColRef' => 'id',
                                  	'TableRef' => 'Table_Types_Rewards',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		        array  ( 'name' => 'middle', 'type' => 11100, 'uns' => true, 'ref' => 0),
		        array  ( 'name' => 'good', 'type' => 11100, 'uns' => true, 'ref' => 0),
		        array  ( 'name' => 'excellent', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    );  	
		    

                   /*$Cols = array ( 0 => array  ( 'name' => 'id_example',
                                  'type' => 10000,
                                  'ref' => true,
                                  'ColRef' => 'id_example',
                                  'TableRef' => 'Table_Examples',
                                  'typeDelete' => 1,
                                  'typeUpdate' => 0
                                ),
                    1 => array  ( 'name' => 'name_example',
                                  'type' => 14100,
                                  'length' => 45,
                                  'ref' => false
                                ),
                    2 => array  ( 'name' => 'number_attempts',
                                  'type' => 11101,
                                  "default_value" => 0,
                                  'uns' => 1,
                                  'ref' => false
                                ),
                    3 => array  ( 'name' => 'time_min',
                                  'type' => 11101,
                                  "default_value" => 100000,
                                  'uns' => 1,
                                  'ref' => false
                                ),
                    4 => array  ( 'name' => 'time_max',
                                  'type' => 11101,
                                  "default_value" => 0,
                                  'uns' => 1,
                                  'ref' => false
                                ),
                    5 => array  ( 'name' => 'qual_max',
                                  'type' => 11101,
                                  "default_value" => -10000,
                                  'uns' => 0,
                                  'ref' => false
                                ),
                 );*/


		    $flag = $this->db->create($this->NameTable,$Cols);
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