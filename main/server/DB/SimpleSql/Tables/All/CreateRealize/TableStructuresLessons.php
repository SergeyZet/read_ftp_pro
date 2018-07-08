<?php
	require_once 'BasePoint.php';
	

	class TableStructuresLessons
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Structures_Lessons'; 
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
		        array  ( 'name' => 'id_lesson', 'type' => 11100, 'uns' => true, 'ref' => 0),
		        array  ( 'name' => 'id_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		        					'ColRef' => 'id',
                                  	'TableRef' => 'Table_Examples',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		        array  ( 'name' => 'number_example_to_lesson', 'type' => 11100, 'uns' => true, 'ref' => 0),
		        array  ( 'name' => 'role_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		        					'ColRef' => 'id',
                                  	'TableRef' => 'Table_Roles_Examples',
                                  	'typeDelete' => 0,
                                  	'typeUpdate' => 1
		    			),

		    );

		    $flag = $this->db->create($this->NameTable,$Cols);
		 	
		 	$Cols = array ( 
		        'name_key' => 'Table_Structures_Lessons_u',
		        'names' => array  ('id_lesson', 'number_example_to_lesson')
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
		
		function GetIdExample($ExampleToLesson,&$idExa){
			$this->connect();	
	
			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id_lesson', 'values' => $statusExe),
		       	1 => array  ( 'name' => 'number_example_to_lesson', 'values' => $themeExe),
		    );
			$ColsCrit[0]['values'][0] = $ExampleToLesson['number_lesson'];
			$ColsCrit[1]['values'][0] = $ExampleToLesson['number_example'];
			$targetCols = array ( 
		        array ( 'name' => 'id_example', 'values' => $value),
		    );

			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			
			$idExa = $targetCols[0]['values'][0];

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "В таблице(".$NameTable.") нет столбцов, удовлетворяющих критериям";

				else echo $flag;
			*/
		}


		function SetLesson(&$Lesson){
			$this->connect();	

			$Cols_Values = array (
		        array  ( 'name' => 'id_lesson', 'value' => $values),
		        array  ( 'name' => 'id_example', 'value' => $values),
		    	array  ( 'name' => 'number_example_to_lesson', 'value' => $values),
		        array  ( 'name' => 'role_example', 'value' => $values),
		    );
			
			$Cols_Values[0]['value'] = $Lesson['number_lesson'];
			$Cols_Values[1]['value'] = $Lesson['id_example'];
			$Cols_Values[2]['value'] = $Lesson['number_example'];
			$Cols_Values[3]['value'] = $Lesson['role_example'];
		
		    $flag = $this->db->setString($this->NameTable, $Cols_Values);

		    if($flag !== 0){
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'id_lesson', 'values' => $values),
			       	1 => array  ( 'name' => 'number_example_to_lesson', 'values' => $values),    
			    );
				$ColsCrit[0]['values'][0] = $Lesson['number_lesson'];
				$ColsCrit[1]['values'][0] = $Lesson['number_example'];
				
				$targetCols = array ( 
			       	0 => array ( 'name' => 'id_lesson', 'values' => $values),
			       	1 => array ( 'name' => 'id_example', 'values' => $values),
			      	2 => array ( 'name' => 'number_example_to_lesson', 'values' => $values),
			       	3 => array ( 'name' => 'role_example', 'values' => $values),
			    );
				
				$flag2 = $this->db->getDataByCriterion($this->NameTable, $targetCols, $ColsCrit);
				
				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		}

		 		if($targetCols[0]['values'][1] !== $Lesson['id_example'] || $targetCols[0]['values'][3] !== $Lesson['role_example']) {
					$this->close();
		 		 	return 2;
		 		}
	        	$flag = 0;	
		    }

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === 2 :	echo "Упражнение урока уже есть и оно с другим содержанием";

				else echo $flag;
			*/
		}

		function SetLessons(&$Lessons){
			$this->connect();	

			for ($i=0; $i < count($Lessons); $i++) { 
				$errorFlag = $this->SetLesson($Lessons[$i]);
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