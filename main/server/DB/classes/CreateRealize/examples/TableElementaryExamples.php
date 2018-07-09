<?php
	require_once 'BasePoint.php';
	

	class TableElementaryExamples
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Elementary_Examples'; 
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
		    	array  ( 'name' => 'id_type_e_e', 'type' => 11100, 'uns' => true, 'ref' => 1,
									'ColRef' => 'id',
                                  	'TableRef' => 'Table_Types_Elementary_Examples',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		    );  	
		    
		    $flag = $this->db->create($this->NameTable,$Cols);

			$Cols = array ( 
		        'name_key' => 'key_EE_u',
		        'names' => array  ('id', 'id_type_e_e')
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
		
		/*
			поля поумолчанию в java через костыль
		*/

		function GetTypesElemExa($idElemExamples,&$idTypeElemExa){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		    );
			for ($i=0; $i < count($idElemExamples); $i++) { 
				$ColsCrit[0]['values'][$i] = $idElemExamples[$i];
			}
			$targetCols = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		       	1 => array ( 'name' => 'id_type_e_e', 'values' => $value),
		    );

			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			
			
			for($i=0; $i < count($targetCols[0]['values']); $i++) {
	            $k = $this->GetIndex($targetCols[0]['values'],$idElemExamples[$i]);
	            if(!isset($k)) {
	                return -1;//ошибка сервера не хватает данных
	            }
	            $idTypeElemExa['id'][$i] = $targetCols[0]['values'][$k];
	            $idTypeElemExa['id_type'][$i] = $targetCols[1]['values'][$k];
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

		function SetElemExaOne(&$ElemExa){
			$this->connect();	

			$Cols_Values = array (
		    	array ( 'name' => 'id_type_e_e', 'value' => $values),
		    );

			$Cols_Values[0]['value'] = $ElemExa['id_type'];	

		    $flag = $this->db->setString($this->NameTable, $Cols_Values);
			
			if($flag === 0) {
    			$flag2 = $this->db->getLastInsertId($ElemExa['id']);
	    		if($flag2 !== 0) { 
	 				$this->close();
	 				return $flag2;
	 			}
		    } else {
				$this->close();
	 			return $flag;   	    	
		    }
	        
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}


		function SetElemExa(&$ElemExa){
			$this->connect();	

			for ($i=0; $i < count($ElemExa); $i++) { 
				$errorFlag = $this->SetElemExaOne($ElemExa[$i]);
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