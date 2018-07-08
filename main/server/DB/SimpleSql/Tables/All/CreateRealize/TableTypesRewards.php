<?php
	require_once 'BasePoint.php';
	

	class TableTypesRewards
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Types_Rewards'; 
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
		        array  ( 'name' => 'name', 'type' => 14100, 'length' => 100, 'ref' => 0),
		    );
/*
			$Cols = array ( 
		        array  ( 'name' => 'id', 'type' => 10000, 'ref' => 0),
		        array  ( 'name' => 'name', 'type' => 14100, 'length' => 100, 'ref' => 0),
		        array  ( 'name' => 'number_time_intervals', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'number_raitings_quality', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'path_to_file_help', 'type' => 14110, 'length' => 200, 'ref' => 0),
		    	array  ( 'name' => 'speech_character', 'type' => 15000, 'length' => 5000, 'ref' => 0),
		    	array  ( 'name' => 'numbers_parts', 'type' => 14110, 'length' => 100, 'ref' => 0),
		    	array  ( 'name' => 'id_theme_example', 'type' => 11000, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Themes_Examples',
                                  	'typeDelete' => 0,
                                  	'typeUpdate' => 1),
		    );  	
		    */


		    
		    $flag = $this->db->create($this->NameTable,$Cols);
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";

				else echo $flag;
			*/
		}


		function SetType(&$typeReward){
			$this->connect();	
			
			$Cols_Values = array (
		        array  ( 'name' => 'name', 'value' => $values),
		    );

			$Cols_Values[0]['value'] = $typeReward['name'];
			
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);

			if($flag !== 0){
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'name', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $typeReward['name'];
				
				$targetCols = array ( 
			       	0 => array ( 'name' => 'id', 'values' => $values),
			       	1 => array ( 'name' => 'name', 'values' => $values),
			    );
				
				$flag2 = $this->db->getDataByCriterion($this->NameTable, $targetCols, $ColsCrit);
				
				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		}
				
	            $typeReward['id'] = $targetCols[0]['values'][0];
	            $typeReward['name'] = $targetCols[1]['values'][0];
				$flag = 0;	
		    } else {
		    	$flag3 = $this->db->getLastInsertId($typeReward['id']);
		    	$this->close();
		 		if($flag3 !== 0) return $flag3;
		    }

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}

		function SetTypes(&$typesRewards){
			$this->connect();	

			for ($i=0; $i < count($typesRewards); $i++) { 
				$errorFlag = $this->SetType($typesRewards[$i]);
				if($errorFlag !== 0) {
					$this->close();			
					return $errorFlag;
				}
			}

		 	$this->close();
		 	return 0;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

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