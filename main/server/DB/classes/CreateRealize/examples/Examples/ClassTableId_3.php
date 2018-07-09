<?php
	class ClassTableId_3
	{
		function GetSpecificCollsTarget() {
			$Cols = array ( 
		        array  ( 'name' => 'word', 'values' => $values),
		    );  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValues($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'word', 'values' => $values),
		    );  	
		    $Cols[0]['values'][0] = $specificity['word'];  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValue($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'word', 'value' => $values),
		    );  	
		    $Cols[0]['value'] = $specificity['word'];  	
		    
		    return $Cols;	
		}

		function GetColsTypes() {	
			$Cols = array ( 
		        array  ( 'name' => 'word', 'type' => 15000, 'length' => 50, 'ref' => 0),
		    );  	
		    
		    return $Cols;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";

				else echo $flag;
			*/
		}
		
	}
?>