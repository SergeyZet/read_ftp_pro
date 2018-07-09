 <?php
	class ClassTableId_1
	{
		function GetSpecificCollsTarget(){
			$Cols = array ( 
		        array  ( 'name' => 'path_to_file_picture', 'values' => $values),
		    );  			    

		    return $Cols;	
		}

		function GetSpecificCollsValues($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'path_to_file_picture', 'values' => $values),
		    );
		    $Cols[0]['values'][0] = $specificity['path_to_file_picture'];  	
		    
		    return $Cols;	
		}

		function GetSpecificCollsValue($specificity){
			$Cols = array ( 
		        array  ( 'name' => 'path_to_file_picture', 'value' => $values),
		    );
		    $Cols[0]['value'] = $specificity['path_to_file_picture'];  	
		    
		    return $Cols;	
		}

		function GetColsTypes(){	
			$Cols = array ( 
		        array  ( 'name' => 'path_to_file_picture', 'type' => 15000, 'length' => 50, 'ref' => 0),
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