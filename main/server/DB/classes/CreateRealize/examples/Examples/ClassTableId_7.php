<?php
	//как вариант хранить в одном поле
	class ClassTableId_7
	{
		function GetSpecificCollsTarget() {
			$Cols = array ( 
		        array  ( 'name' => 'picture_1', 'values' => $values),
		    	array  ( 'name' => 'picture_2', 'values' => $values),
		    );  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValues($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'picture_1', 'values' => $values),
		    	array  ( 'name' => 'picture_2', 'values' => $values),
		    );
		    $Cols[0]['values'][0] = $specificity['text'];  	
		    $Cols[1]['values'][0] = $specificity['questions'];  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValue($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'picture_1', 'value' => $values),
		    	array  ( 'name' => 'picture_2', 'value' => $values),
		   	);
		    $Cols[0]['value'] = $specificity['picture_1'];  	
		    $Cols[1]['value'] = $specificity['picture_2'];  	
		    
		    return $Cols;	
		}

		function GetColsTypes() {	
			$Cols = array ( 
		        array  ( 'name' => 'picture_1', 'type' => 15000, 'length' => 30000, 'ref' => 0),
		    	array  ( 'name' => 'picture_2', 'type' => 15000, 'length' => 5000, 'ref' => 0),
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