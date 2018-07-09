<?php
	require_once 'BasePoint.php';
	

	class TableThemesExamples
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;			
	
		function __construct($openConnect = 0, $db = false){
			$this->NameTable = 'Table_Themes_Examples'; 
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

		/*
			Редактировать колонки
		*/
		function create(){
			$this->connect();
		
			$Cols = array ( 
		        array  ( 'name' => 'id', 'type' => 10000, 'ref' => 0),
		        array  ( 'name' => 'name', 'type' => 14110, 'length' => 100, 'ref' => 0),
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

		function GetIndex($mas,$value){
	        for ($i=0; $i < count($mas); $i++) { 
	            if($value === $mas[$i]) {
	                return $i;
	            }
	        }
	        return null;
	    }
		
		function GetThemes($idThemes,&$Themes){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'id', 'values' => $values),
		    );
			for ($i=0; $i < count($idThemes); $i++) { 
				$ColsCrit[0]['values'][$i] = $idThemes[$i];
			}
			$targetCols = array ( 
		       	0 => array ( 'name' => 'id', 'values' => $values),
		       	1 => array ( 'name' => 'name', 'values' => $values),
		    );
			
			$flag = $this->db->getDataByCriterion($this->NameTable,$targetCols,$ColsCrit);
			
			for($i=0; $i < count($targetCols[0]['values']); $i++) {
	            $k = $this->GetIndex($targetCols[0]['values'],$idThemes[$i]);
	            if(!isset($k)) {
	                return -1;//ошибка сервера не хватает данных
	            }
	            $Themes['id'][$i] = $targetCols[0]['values'][$k];
	            $Themes['themes'][$i] = $targetCols[1]['values'][$k];
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


		//доработать GetLastId


		function SetTheme(&$Theme){
			$this->connect();	
		
			$Cols_Values = array (
		        array  ( 'name' => 'name', 'value' => $value),
		    );
			
			$Cols_Values[0]['value'] = $Theme['theme'];
				
			$flag = $this->db->setString($this->NameTable, $Cols_Values);

		    if($flag !== 0){
				$ColsCrit = array ( 
			       	0 => array  ( 'name' => 'name', 'values' => $values),
			    );
				$ColsCrit[0]['values'][0] = $Theme['theme'];
				
				$targetCols = array ( 
			       	0 => array ( 'name' => 'id', 'values' => $values),
			       	1 => array ( 'name' => 'name', 'values' => $values),
			    );
				
				$flag2 = $this->db->getDataByCriterion($this->NameTable, $targetCols, $ColsCrit);
				
				if($flag2 !== 0) {
					$this->close();
		 		 	return $flag.' '.$flag2;
		 		}
				
	            $Theme['id'] = $targetCols[0]['values'][0];
	            $Theme['theme'] = $targetCols[1]['values'][0];
				$flag = 0;	
		    } else {
		    	$flag3 = $this->db->getLastInsertId($Theme['id']);
		    	$this->close();
		 		if($flag3 !== 0) return $flag3;
		    }

	 		$this->close();
	 		return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";
				$flag === -1 :	echo "Ошибка сервера не хватает данных";
				
				else echo $flag;
			*/
		}

		function SetThemes(&$Themes) {
			$this->connect();	

			for ($i=0; $i < count($Themes); $i++) { 
				$errorFlag = $this->SetTheme($Themes[$i]);
				if($errorFlag !== 0) {
					echo "|Th ".$errorFlag." Th|";
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