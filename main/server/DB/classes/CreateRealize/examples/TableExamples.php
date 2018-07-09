<?php
	require_once 'BasePoint.php';
	

	class TableExamples
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Examples'; 
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
		        array  ( 'name' => 'name', 'type' => 14110, 'length' => 50, 'ref' => 0),
		    	array  ( 'name' => 'id_type', 'type' => 11100, 'uns' => true, 'ref' => 1,
									'ColRef' => 'id',
                                  	'TableRef' => 'Table_Types_Examples',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
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
		
		function GetTypeIdExample($idExa,&$idTypeExa){
			$this->connect();	

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		    	//2 => array  ( 'name' => 'role_exesize', 'value' => $roleExe),	
		    );
			$ColsCrit[0]['values'][0] = $idExa;
			$targetCols = array ( 
		        array ( 'name' => 'id_type', 'values' => $value),
		    );

			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			
			$idTypeExa = $targetCols[0]['values'][0];

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "В таблице(".$NameTable.") нет столбцов, удовлетворяющих критериям";

				else echo $flag;
			*/
		}

		function SetExample(&$Example){
			$this->connect();	
			
			$Cols_Values = array (
		        array ( 'name' => 'name', 'value' => $values),
		       	array ( 'name' => 'id_type', 'value' => $values),
			);
		   
			$Cols_Values[0]['value'] = $Example['name'];
			$Cols_Values[1]['value'] = $Example['id_type'];
			
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);

			if($flag !== 0){
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'name', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $Example['name'];
				
				$targetCols = array ( 
			       	0 => array ( 'name' => 'id', 'values' => $values),
			       	1 => array ( 'name' => 'name', 'values' => $values),
			       	2 => array ( 'name' => 'id_type', 'values' => $values),
			    );
				
				$flag2 = $this->db->getDataByCriterion($this->NameTable, $targetCols, $ColsCrit);
				
				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		}
				
				if($targetCols[2]['values'][0] !== $Example['id_type']) {
					$this->close();
		 		 	return 2;
				}

	            $Example['id'] = $targetCols[0]['values'][0];
	        	
				$flag = 0;	
		    } else {
		    	$flag3 = $this->db->getLastInsertId($Example['id']);
		    	$this->close();
		 		if($flag3 !== 0) return $flag3;
		    }

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "Упражнение с таким названием(".$Example['name'].") уже существует и у него другой тип";

				else echo $flag;
			*/
		}

		function SetExamples(&$Examples){
			$this->connect();	

			for ($i=0; $i < count($Examples); $i++) { 
				$errorFlag = $this->SetExample($Examples[$i]);
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