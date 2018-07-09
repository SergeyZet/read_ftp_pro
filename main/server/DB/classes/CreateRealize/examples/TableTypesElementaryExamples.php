<?php
	require_once 'BasePoint.php';


	class TableTypesElementaryExamples
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Types_Elementary_Examples'; 
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
		        array  ( 'name' => 'name', 'type' => 14100, 'length' => 100, 'ref' => 0),
		        array  ( 'name' => 'id_type_structure_table_e_e', 'type' => 11100, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Structures_Tables_E_E',
                                  	'typeDelete' => 0,
                                  	'typeUpdate' => 1),
		        //array  ( 'name' => 'time_interval', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    	//array  ( 'name' => 'raiting_quality', 'type' => 11100, 'uns' => true, 'ref' => 0),
		    	array  ( 'name' => 'path_to_file_help', 'type' => 14110, 'length' => 200, 'ref' => 0),
		    	array  ( 'name' => 'speech_character', 'type' => 15000, 'length' => 500, 'ref' => 0),
		    	array  ( 'name' => 'id_theme_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Themes_Examples',
                                  	'typeDelete' => 0,
                                  	'typeUpdate' => 1),
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
		
		//2 => array ( 'name' => 'id_type_structure_table_e_e', 'values' => $value), - нужно ли ?
		function GetContents($idTEE,&$ContentByIdTypeEE) {
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);
			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		    );
			for ($i=0; $i < count($idTEE); $i++) { 
				$ColsCrit[0]['values'][$i] = $idTEE[$i];
			}
			$targetCols = array ( 
		       	0 => array ( 'name' => 'id', 'values' => $values),
		       	1 => array ( 'name' => 'name', 'values' => $value),
		       	2 => array ( 'name' => 'id_type_structure_table_e_e', 'values' => $value),
		       	3 => array ( 'name' => 'path_to_file_help', 'values' => $value),
		       	4 => array ( 'name' => 'speech_character', 'values' => $value),
		       	5 => array ( 'name' => 'id_theme_example', 'values' => $value),
		    );

			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			

			for($i=0; $i < count($targetCols[0]['values']); $i++) {
	            $k = $this->GetIndex($targetCols[0]['values'],$idTEE[$i]);
	            if(!isset($k)) {
	                return -1;//ошибка сервера не хватает данных
	            }
				$ContentByIdTypeEE['id'][$i] = $targetCols[0]['values'][$k];
		    	$ContentByIdTypeEE['content'][$i]['name_type'] = $targetCols[1]['values'][$k];
		    	$ContentByIdTypeEE['content'][$i]['help'] = $targetCols[3]['values'][$k];
		    	$ContentByIdTypeEE['content'][$i]['replicas'] = explode("|", $targetCols[4]['values'][$k]);
		    	$ContentByIdTypeEE['id_theme'][$i] = $targetCols[5]['values'][$k]; 
	        	$ContentByIdTypeEE['id_structure'][$i] = $targetCols[2]['values'][$k];
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
		
		function GetTypeElemExampleByName($name,&$ContentTEE) {
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);
			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'name', 'values' => $values),
		    );
			$ColsCrit[0]['values'][0] = $name;
			$targetCols = array ( 
		       	0 => array ( 'name' => 'id', 'values' => $values),
		       	1 => array ( 'name' => 'name', 'values' => $value),
		       	2 => array ( 'name' => 'id_type_structure_table_e_e', 'values' => $value),
		       	3 => array ( 'name' => 'path_to_file_help', 'values' => $value),
		       	4 => array ( 'name' => 'speech_character', 'values' => $value),
		       	5 => array ( 'name' => 'id_theme_example', 'values' => $value),
		    );

			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			

			$ContentTEE['id'] = $targetCols[0]['values'][0];
	    	$ContentTEE['name'] = $targetCols[1]['values'][0];
	    	$ContentTEE['id_structures'] = $targetCols[2]['values'][0];
	    	$ContentTEE['help'] = $targetCols[3]['values'][0];
	    	$ContentTEE['replicas'] = $targetCols[4]['values'][0]; 
	    	$ContentTEE['id_theme'] = $targetCols[5]['values'][0]; 

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "В таблице(".$NameTable.") нет столбцов, удовлетворяющих критериям";

				else echo $flag;
			*/
		}

		function SetType(&$ContentTypeEE){
			$this->connect();	

			$Cols_Values = array (
				array ( 'name' => 'name', 'value' => $values),
		       	array ( 'name' => 'id_type_structure_table_e_e', 'value' => $values),
		       	array ( 'name' => 'path_to_file_help', 'value' => $values),
		       	array ( 'name' => 'speech_character', 'value' => $values),
		       	array ( 'name' => 'id_theme_example', 'value' => $values),
			);

			$Cols_Values[0]['value'] = $ContentTypeEE['name'];
			$Cols_Values[1]['value'] = $ContentTypeEE['id_structures'];
			$Cols_Values[2]['value'] = $ContentTypeEE['help'];
			$Cols_Values[3]['value'] = $ContentTypeEE['replicas'];
			$Cols_Values[4]['value'] = $ContentTypeEE['id_theme'];	
		
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);
			
			if($flag !== 0) {
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'name', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $ContentTypeEE['name'];

				$targetCols = array ( 
			       	0 => array ( 'name' => 'id', 'values' => $values),
			    );

				$flag2 = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);				

				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		} else {
		 			$ContentTypeEE['id'] = $targetCols[0]['values'][0];
		 			$flag = 2;
		 		}
			} else {
		    	$flag3 = $this->db->getLastInsertId($ContentTypeEE['id']);
		    	$this->close();
		 		if($flag3 !== 0) return $flag3;
			}
			
	        
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "Упражнение с таким названием (".$ContentTypeEE['name'].") уже существует";

				else echo $flag;
			*/
		}

		function SetTypes(&$ContentTypeEE){
			$this->connect();	

			$errorFlag = 0;
			for ($i=0; $i < count($ContentTypeEE); $i++) { 
				$errorFlag = $this->SetType($ContentTypeEE[$i]);
			}

		 	$this->close();
		 	return $errorFlag;   
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