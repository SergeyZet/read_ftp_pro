<?php
	require_once 'BasePoint.php';
	require_once 'Examples\libFactoryTablesByExa.php';

	class TableElemExaByTypesId
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
		var $Type;
		function __construct($Type, $openConnect = 0, $db = false){
			$this->NameTable = 'Table_Elementary_Examples_type_'."$Type"; 
			$this->openConnect = $openConnect;
			$this->Type = $Type;
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
		
		function create($ConfigurationTypeTable) {
			$this->connect();

			if($ConfigurationTypeTable['name_table_id'] !== $this->Type) {
				return 2;
			}

			//Basics:
			$Cols = array (  
		        array  ( 'name' => 'id', 'type' => 10000, 'ref' => 0),
		        array  ( 'name' => 'name', 'type' => 14110, 'length' => 50, 'ref' => 0),
		    	array  ( 'name' => 'id_e_e_to_system', 'type' => 11010, 'uns' => true, 'ref' => 1,
									'ColRef' => 'id',
                                  	'TableRef' => 'Table_Elementary_Examples',
                                  	'typeDelete' => 2,
                                  	'typeUpdate' => 1),
		    );			

			for($i = 0; $i < $ConfigurationTypeTable['number_time_intervals']; $i++) {
				$Cols[count($Cols)] = array  ( 'name' => ('min_time_bad_'.$i), 'type' => 11100, 'uns' => true, 'ref' => 0);
				$Cols[count($Cols)] = array  ( 'name' => ('max_time_bad_'.$i), 'type' => 11100, 'uns' => true, 'ref' => 0);
				$Cols[count($Cols)] = array  ( 'name' => ('min_time_fishily_'.$i), 'type' => 11100, 'uns' => true, 'ref' => 0);
				$Cols[count($Cols)] = array  ( 'name' => ('max_time_fishily_'.$i), 'type' => 11100, 'uns' => true, 'ref' => 0);
			}
			for($i = 0; $i < $ConfigurationTypeTable['number_ratings_quality']; $i++) {
				$Cols[count($Cols)] = array  ( 'name' => ('rating_quality_'.$i), 'type' => 11100, 'uns' => false, 'ref' => 0);
			}
			

			$Factory = new FactoryTablesById();
			$table = $Factory->GetTable($ConfigurationTypeTable['name_table_id']);
			$ColsSpecifity = $table->GetColsTypes();
			for($i = 0; $i < count($ColsSpecifity); $i++) {
				$Cols[count($Cols)] = $ColsSpecifity[$i];
			}
			
			
			//Specificity:
			//Через встренную библиотеку классов

		    $flag = $this->db->create($this->NameTable,$Cols);
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";
				$flag === 2 :	echo "Неверный id_type_table";
				else echo $flag;
			*/
		}

		function GetNameColls(&$namesCols){
			$this->connect();
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id_e_e_to_system', 'values' => $values),
		    );
			$ColsCrit[0]['values'][0] = $idElemExamples;

			$Factory = new FactoryTablesById();
			$TableSpecifity = $Factory->GetTable($this->Type);
			$targetColsSpec = $TableSpecifity->GetSpecificCollsTarget();
			for ($i=0; $i < count($targetColsSpec); $i++) { 
				$namesCols[$i] = $targetColsSpec[$i]['name'];
			}
		 	$this->close();
		 	return 0;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";
				$flag === 2 :	echo "Неверный id_type_table";
				else echo $flag;
			*/

		}
		
		function GetContentEEById($idElemExamples,$strucure,&$ElemExamples){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id_e_e_to_system', 'values' => $values),
		    );
			$ColsCrit[0]['values'][0] = $idElemExamples;

			$Factory = new FactoryTablesById();
			$TableSpecifity = $Factory->GetTable($this->Type);
			
			$targetCols = array ( 
		       	0 => array  ( 'name' => 'name', 'values' => $values),
		    );

		    for($i = 0; $i < $strucure['number_intervals']; $i++) {
				$targetCols[count($targetCols)] = array  ( 'name' => ('min_time_bad_'.$i), 'values' => $values);
				$targetCols[count($targetCols)] = array  ( 'name' => ('max_time_bad_'.$i), 'values' => $values);
				$targetCols[count($targetCols)] = array  ( 'name' => ('min_time_fishily_'.$i), 'values' => $values);
				$targetCols[count($targetCols)] = array  ( 'name' => ('max_time_fishily_'.$i), 'values' => $values);
			}
			for($i = 0; $i < $strucure['number_ratings']; $i++) {
				$targetCols[count($targetCols)] = array  ( 'name' => ('rating_quality_'.$i), 'values' => $values);
			}

			$targetColsSpec = $TableSpecifity->GetSpecificCollsTarget();
			for ($i=0; $i < count($targetColsSpec); $i++) { 
				$targetCols[count($targetCols)] = $targetColsSpec[$i];
			}

			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			
			for($i = 0; $i < count($targetCols); $i++) {
				$ElemExamples['specificity'][$targetCols[$i]['name']] = $targetCols[$i]['values'][0];
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
		

		function SetElemExa(&$ElemExample,$Structure){
			$this->connect();	

			
			$Cols_Values = array (  
		        array  ( 'name' => 'name', 'value' => $values),
		    	array  ( 'name' => 'id_e_e_to_system', 'value' => $values),
		    );			
			
			$Cols_Values[0]['value'] = $ElemExample['name'];
			$Cols_Values[1]['value'] = $ElemExample['id_e_e'];	
		
			for($i = 0; $i < $Structure['number_intervals']; $i++) {
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => ('min_time_bad_'.$i), 'value' => $values);
				$nameKey = 'min_time_bad_'.$i;           
				$Cols_Values[count($Cols_Values)-1]['value'] = $ElemExample[$nameKey];
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => ('max_time_bad_'.$i), 'value' => $values);
				$nameKey = 'max_time_bad_'.$i;
				$Cols_Values[count($Cols_Values)-1]['value'] = $ElemExample[$nameKey];
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => ('min_time_fishily_'.$i), 'value' => $values);
				$nameKey = 'min_time_fishily_'.$i;
				$Cols_Values[count($Cols_Values)-1]['value'] = $ElemExample[$nameKey];
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => ('max_time_fishily_'.$i), 'value' => $values);
				$nameKey = 'max_time_fishily_'.$i;
				$Cols_Values[count($Cols_Values)-1]['value'] = $ElemExample[$nameKey];
			}
			for($i = 0; $i < $Structure['number_raitings']; $i++) {
				$Cols_Values[count($Cols_Values)] = array  ( 'name' => ('rating_quality_'.$i), 'value' => $values);
				$nameKey = 'rating_quality_'.$i;
				$Cols_Values[count($Cols_Values)-1]['value'] = $ElemExample[$nameKey];
			}

			$Factory = new FactoryTablesById();
			$TableSpecifity = $Factory->GetTable($this->Type);
			$Specific_Cols = $TableSpecifity->GetSpecificCollsValue($ElemExample['specificity']);
			
			for($i = 0; $i < count($Specific_Cols); $i++) {
				$Cols_Values[count($Cols_Values)] = $Specific_Cols[$i];
			}

		    $flag = $this->db->setString($this->NameTable, $Cols_Values);
			
			if($flag !== 0) {
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'name', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $ElemExample['name'];

				$targetCols = array ( 
			       	0 => array ( 'name' => 'id', 'values' => $values),
			    );

				$flag2 = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);				

				if( $flag2 === 0 ) {
					$this->close();
		 		 	return 2;	
				} else {
					$ColsCrit = array ( 
				       	0 => array  ( 'name' => 'id_e_e_to_system', 'values' => $values),
				    );
					$ColsCrit[0]['values'][0] = $ElemExample['id_e_e'];

					$targetCols = array ( 
				       	0 => array ( 'name' => 'id', 'values' => $values),
				    );

					$flag3 = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);		
					if( $flag3 === 0 ) {
						$this->close();
			 		 	return 3;	
					} else {
						$this->close();
			 		 	return $flag.'|'.$flag2.'|'.$falg3;	
					}		
				}
			} else {
				$flag2 = $this->db->getLastInsertId($ElemExample['id']);
		    	$this->close();
		 		if($flag2 !== 0) return $flag2;
			}
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "Упражнение с таким названием (".$ElemExample['name'].") уже существует";
				$flag === 3 :	echo "Упражнение с таким id (".$ElemExample['id_e_e'].") уже существует в системе (TableElementaryExamples)";

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