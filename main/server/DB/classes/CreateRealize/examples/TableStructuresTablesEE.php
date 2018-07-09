<?php
	require_once 'BasePoint.php';
	

	class TableStructuresTablesEE
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Structures_Tables_E_E'; 
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
		        array  ( 'name' => 'number_raitings_quality', 'type' => 11100, 'uns' => true, 'ref' => 0),
		        array  ( 'name' => 'number_time_intervals', 'type' => 11100, 'uns' => true, 'ref' => 0), 
		    );  	
		    
		    $flag = $this->db->create($this->NameTable,$Cols);
		 	
		 	$Cols = array ( 
		        'name_key' => 'Table_Structures_Tables_E_E_u',
		        'names' => array  ('number_raitings_quality', 'number_time_intervals')
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


		function GetStructures($idStructures,&$Structures){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		    );
			for ($i=0; $i < count($idStructures); $i++) { 
				$ColsCrit[0]['values'][$i] = $idStructures[$i];
			}
			$targetCols = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		        1 => array  ( 'name' => 'number_raitings_quality', 'values' => $value),
		        2 => array  ( 'name' => 'number_time_intervals', 'values' => $value), 
		    );
			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			
			for($i=0; $i < count($targetCols[0]['values']); $i++) {
	            $k = $this->GetIndex($targetCols[0]['values'],$idStructures[$i]);
	            if(!isset($k)) {
	                return -1;//ошибка сервера не хватает данных
	            }
	            $Structures['id'][$i] = $idStructures[$i];
	            $Structures['number_raitings'][$i] = $targetCols[1]['values'][$k];
	        	$Structures['number_intervals'][$i] = $targetCols[2]['values'][$k];
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

		function SetStructure(&$Structure){
			$this->connect();	

		
			$Cols_Values = array (
		        array  ( 'name' => 'number_raitings_quality', 'value' => $value),
		        array  ( 'name' => 'number_time_intervals', 'value' => $value), 
		    );

			$Cols_Values[0]['value'] = $Structure['number_raitings'];
			$Cols_Values[1]['value'] = $Structure['number_intervals'];	
		
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);
			
			if($flag !== 0) {
				$ColsCrit = array ( 
			        array  ( 'name' => 'number_raitings_quality', 'values' => $value),
			        array  ( 'name' => 'number_time_intervals', 'values' => $value), 
			    );
				$ColsCrit[0]['values'][0] = $Structure['number_raitings'];
				$ColsCrit[1]['values'][0] = $Structure['number_intervals'];
				
				$targetCols = array ( 
			        array  ( 'name' => 'id', 'values' => $value),
			        array  ( 'name' => 'number_raitings_quality', 'values' => $value),
			        array  ( 'name' => 'number_time_intervals', 'values' => $value), 
			    );
					
				$flag2 = $this->db->getDataByCriterion($this->NameTable, $targetCols, $ColsCrit);
				
				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		}
				
	            $Structure['id'] = $targetCols[0]['values'][0];
	            $flag = 0;
	        } else {
		    	$flag3 = $this->db->getLastInsertId($Structure['id']);
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
	    
	    function SetStructures(&$Structures){
			$this->connect();	

			for ($i=0; $i < count($Structures); $i++) { 
				$errorFlag = $this->SetStructure($Structures[$i]);
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