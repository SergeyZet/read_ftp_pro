<?php
	class ClassTableId_4
	{
		function GetSpecificCollsTarget() {
			$Cols = array ( 
		        array  ( 'name' => 'number_calc_vertical', 'values' => $values),
		    	array  ( 'name' => 'number_calc_gorizontal', 'values' => $values),
		    	array  ( 'name' => 'number_pictures', 'values' => $values),
		    );  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValues($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'number_calc_vertical', 'values' => $values),
		    	array  ( 'name' => 'number_calc_gorizontal', 'values' => $values),
		    	array  ( 'name' => 'number_pictures', 'values' => $values),
		    );  	
		    $Cols[0]['values'][0] = $specificity['number_calc_vertical'];  	
		    $Cols[1]['values'][0] = $specificity['number_calc_gorizontal'];
		    $Cols[2]['values'][0] = $specificity['number_pictures'];  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValue($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'number_calc_vertical', 'value' => $values),
		    	array  ( 'name' => 'number_calc_gorizontal', 'value' => $values),
		    	array  ( 'name' => 'number_pictures', 'value' => $values),
		    );  	
		    $Cols[0]['value'] = $specificity['number_calc_vertical'];  	
		    $Cols[1]['value'] = $specificity['number_calc_gorizontal'];
		    $Cols[2]['value'] = $specificity['number_pictures'];  	
		    
		    return $Cols;	
		}

		function GetColsTypes() {	
			$Cols = array ( 
		        array  ( 'name' => 'number_calc_vertical', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'number_calc_gorizontal', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'number_pictures', 'type' => 11100, 'uns' => true, 'ref' => 0),
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