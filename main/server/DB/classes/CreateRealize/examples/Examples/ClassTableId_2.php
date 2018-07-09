 <?php
	class ClassTableId_2
	{
		function GetSpecificCollsTarget(){
			$Cols = array ( 
		        array  ( 'name' => 'words', 'values' => $values),
		    );  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValues($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'words', 'values' => $values),
		    );  	
		    $Cols[0]['values'][0] = $specificity['words'];  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValue($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'words', 'value' => $values),
		    );  	
		    $Cols[0]['value'] = $specificity['words'];  	
		    
		    return $Cols;	
		}

		function GetColsTypes(){	
			$Cols = array ( 
		        array  ( 'name' => 'words', 'type' => 15000, 'length' => 100, 'ref' => 0),
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