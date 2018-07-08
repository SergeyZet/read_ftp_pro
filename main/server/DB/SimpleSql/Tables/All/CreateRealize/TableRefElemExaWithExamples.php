<?php
	require_once 'BasePoint.php';
	

	class TableRefElemExaWithExamples
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Ref_Elem_Exa_With_Examples'; 
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
		        array  ( 'name' => 'id_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		   										'ColRef' => 'id',
			                                  	'TableRef' => 'Table_Examples',
			                                  	'typeDelete' => 1,
			                                  	'typeUpdate' => 1),
		        array  ( 'name' => 'id_elementary_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		   										'ColRef' => 'id',
			                                  	'TableRef' => 'Table_Elementary_Examples',
			                                  	'typeDelete' => 1,
			                                  	'typeUpdate' => 1),
		    	array  ( 'name' => 'number', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    );  	

		    
		    $flag = $this->db->create($this->NameTable,$Cols);

		    $Cols = array ( 
		        'name_key' => 'ref_EE_E_u',
		        'names' => array  ('id_example', 'number')
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
		
		function GetElemExaToExa($idExample,&$idElemExamples){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id_example', 'values' => $values),
		    );
			$ColsCrit[0]['values'][0] = $idExample;
			//Запрос для хранилища
			
			$targetCols = array ( 
		       	0 => array ( 'name' => 'id_elementary_example', 'values' => $value),
		       	1 => array ( 'name' => 'number', 'values' => $value),
		    );

			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit,'number');
			
			for ($i=0; $i < count($targetCols[0]['values']); $i++) { 
				$idElemExamples[$i] = $targetCols[0]['values'][$i];
			}
			

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "В таблице(".$NameTable.") нет столбцов, удовлетворяющих критериям";

				else echo $flag;
			*/
		}


		function SetExample(&$RefElemExample){
			$this->connect();	

			$Cols_Values = array (
		       	array ( 'name' => 'id_example', 'value' => $values),
		       	array ( 'name' => 'id_elementary_example', 'value' => $value),
		       	array ( 'name' => 'number', 'value' => $value),
			);

			$Cols_Values[0]['value'] = $RefElemExample['id_example'];
			$Cols_Values[1]['value'] = $RefElemExample['id_elementary_example'];
			$Cols_Values[2]['value'] = $RefElemExample['number'];
		
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);

			if($flag !== 0){
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'id_example', 'values' => $values),
			       	1 => array  ( 'name' => 'number', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $RefElemExample['name'];
				
				$targetCols = array ( 
			       	0 => array ( 'name' => 'id_example', 'values' => $values),
			       	1 => array ( 'name' => 'id_elementary_example', 'values' => $values),
			       	2 => array ( 'name' => 'number', 'values' => $values),
			    );
				
				$flag2 = $this->db->getDataByCriterion($this->NameTable, $targetCols, $ColsCrit);
				
				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		}
				
				if($targetCols[1]['values'][0] !== $RefElemExample['id_elementary_example']) {
					$this->close();
		 		 	return 2;
				}
				$flag = 0;	
		    }

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "Связь такая уже существует, но у неё другое элементарное упражнение";

				else echo $flag;
			*/
		}

		function SetExamples(&$RefElemExamples){
			$this->connect();	

			for ($i=0; $i < count($RefElemExamples); $i++) { 
				$errorFlag = $this->SetExample($RefElemExamples[$i]);
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