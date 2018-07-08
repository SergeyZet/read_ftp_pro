<?php
	require_once 'BasePoint.php';
	

	class TableTypesExamples
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Types_Examples'; 
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
		        array  ( 'name' => 'name', 'type' => 14110, 'length' => 100, 'ref' => 0),
		    	array  ( 'name' => 'speech_character', 'type' => 15000, 'length' => 500, 'ref' => 0),
		    	array  ( 'name' => 'path_to_file_help', 'type' => 15000, 'length' => 500, 'ref' => 0),
		    	array  ( 'name' => 'description', 'type' => 15000, 'length' => 5000, 'ref' => 0),			//??
		    	array  ( 'name' => 'id_type_reward', 'type' => 11100, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Types_Rewards',
                                  	'typeDelete' => 0,
                                  	'typeUpdate' => 1),
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
		
		function GetDescriptionById($idTypeExa,&$typeExa){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$StringsValues;

			$flag = $this->db->getAllFromString($this->NameTable,$StringsValues,'id', $idTypeExa);
			
			$typeExa['speech_character'] = explode("|", $StringsValues['speech_character']);
			$typeExa['path_to_help'] = $StringsValues['path_to_file_help'];
			$typeExa['name'] = $StringsValues['name'];



		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "В таблице(".$NameTable.") нет столбцов, удовлетворяющих критериям";

				else echo $flag;
			*/
		}

		function SetType(&$typeExample){
			$this->connect();	

			
			$Cols_Values = array (
       			array ( 'name' => 'name', 'value' => $values),
		       	array ( 'name' => 'speech_character', 'value' => $values),
		       	array ( 'name' => 'path_to_file_help', 'value' => $values),
		       	array ( 'name' => 'description', 'value' => $values),
		       	array ( 'name' => 'id_type_reward', 'value' => $values),
			);

			$Cols_Values[0]['value'] = $typeExample['name'];
			$Cols_Values[1]['value'] = $typeExample['replicas'];
			$Cols_Values[2]['value'] = $typeExample['help'];
			$Cols_Values[3]['value'] = '';
			$Cols_Values[4]['value'] = $typeExample['id_type_reward'];	
		
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);
			
			if($flag !== 0) {
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'name', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $typeExample['name'];

				$targetCols = array ( 
			       	0 => array ( 'name' => 'id', 'values' => $values),
			    );

				$flag2 = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);				

				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		} else {
		 			$typeExample['id'] = $targetCols[0]['values'][0];
		 			$flag = 2;
		 		}
			} else {
		    	$flag3 = $this->db->getLastInsertId($typeExample['id']);
		    	$this->close();
		 		if($flag3 !== 0) return $flag3;
			}
			
	        
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "Тип упражнение с таким названием (".$typeExample['name'].") уже существует";

				else echo $flag;
			*/
		}

		function SetTypes(&$typesExamples){
			$this->connect();	

			for ($i=0; $i < count($typesExamples); $i++) { 
				$errorFlag = $this->SetType($typesExamples[$i]);
			}

		 	$this->close();
		 	return $errorFlag;   
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