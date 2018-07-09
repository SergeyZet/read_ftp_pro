<?php
	class ClassTableId_5
	{
		function GetSpecificCollsTarget() {
			$Cols = array ( 
		        array  ( 'name' => 'text', 'values' => $values),
		    	array  ( 'name' => 'questions', 'values' => $values),
		    );  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValues($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'text', 'values' => $values),
		    	array  ( 'name' => 'questions', 'values' => $values),
		    );
		    $Cols[0]['values'][0] = $specificity['text'];  	
		    $Cols[1]['values'][0] = $specificity['questions'];  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValue($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'text', 'value' => $values),
		    	array  ( 'name' => 'questions', 'value' => $values),
		    );
		    $Cols[0]['value'] = $specificity['text'];  	
		    $Cols[1]['value'] = $specificity['questions'];  	
		    
		    return $Cols;	
		}

		function GetColsTypes() {	
			$Cols = array ( 
		        array  ( 'name' => 'text', 'type' => 15000, 'length' => 30000, 'ref' => 0),
		    	array  ( 'name' => 'questions', 'type' => 15000, 'length' => 5000, 'ref' => 0),
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