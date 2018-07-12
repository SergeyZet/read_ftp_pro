<?php
	require_once 'SimpleSQLClass.php';

	class OneClickMyDB
	{	
		var $openConnect;
		var $db;
		function  __construct($openConnect = 0, $dataBase = false){
            $this->openConnect = $openConnect;
        	echo "SSS";
        
        	if ($this->openConnect === 1) {
        		$this->db = new MyDB();
        		$this->db->connect();
        	}
        	if ($this->openConnect === 2) {
        		$this->db = $dataBase;
        	}
        }/*

		function screening($data) {
			$this->connect();
			$ShieldData = $this->db->screening($data);
			$this->privateClose();
			return $ShieldData;
		}

		function connect(){
        	if ($this->openConnect === 0) {
				$this->db = new MyDB();
				$this->db->connect();
        	}
        }

		function privateClose(){
        	if ($this->openConnect === 0) {
				$this->db->close();
        	}
        }
    
		function __destruct(){
        	if ($this->openConnect === 1) {
				$this->db->close();
        	}
        }

        function checkTableIsExistance($NameTable, $exist = true){
        	$query = "SHOW TABLES LIKE '$NameTable'";
        	//echo $NameTable;
	        
	        $this->db->run($query);
	        $res = $this->db->row(0);
	        
	        $res1 = ($res === null) === !$exist; 
	        if(!$res1) 
	        	$this->privateClose();
	        
	        return $res1;	
        }

        function checkKeyToTableIsExistance($NameTable, $NameKey, $exist = true){
        	$query = "SHOW KEYS FROM '$NameTable' WHERE Key_name = $NameKey";
        	//echo $NameTable;
	        
	        $this->db->run($query);
	        $res = $this->db->row(0);
	        echo "|".$res."|";
	        $res1 = ($res === null) === !$exist; 
	        if(!$res1) 
	        	$this->privateClose();
	        
	        return $res1;	
        }
        //может работать неправильно
		function countRecords($NameTable, &$count){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
			    
            $query = "SELECT COUNT(*) FROM `$NameTableSheilded`";
		   
		    $this->db->run($query); //при передаче пустого запроса err ==''

            if(!$this->db->getError())
            {
                $count = count(($this->db->row(0)));
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            } 
			$this->privateClose(); 
			
			return $flag;
		}
		//проверить
		function GetLastId($NameTable, &$id, $idName){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);
			$idNameSheilded = $this->db->screening($idName);
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
			    
            $query = "SELECT MAX(`$idNameSheilded`) FROM `$NameTableSheilded`";
		   
		    $this->db->run($query); //при передаче пустого запроса err ==''

            if(!$this->db->getError())
            {
                $count = $this->db->row(0);
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            } 
			$this->privateClose(); 
			
			return $flag;
		}

		function getLastInsertId(&$id){
			$this->connect();
            
		    $id = $this->db->last_insert_id();
            $flag = $this->db->getError();//непонятное исключение
            $this->privateClose(); 
			
			return $flag;
		}			

		function getAllFromString($NameTable, &$StringsValues, $ColName, $ColValue){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);
	        
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
			

			$ColNameSheilded = $this->db->screening($ColName);
	        $ColValueSheilded = $this->db->screening($ColValue);
	        
            $query = "SELECT * FROM `$NameTableSheilded` WHERE `$ColNameSheilded`= '{$ColValueSheilded}'";
		   	//echo $query;
		    $this->db->run($query); //при передаче пустого запроса err ==''

            if(!$this->db->getError())
            {
                $num_rows = $this->db->num_rows();
                if($num_rows !== 0)
	            {
	                if($num_rows === 1){
	                	$StringsValues = $this->db->row(0);
	                	$flag = 0;
	                } else {
	                	$flag = 3;//// в колнке несколько записей с таким значением
	                }    
	            } else {
	                $flag = 2;// в колнке нет такого значения 
	            }
            } else {
                $flag = $this->db->getError();//непонятное исключение
            } 
			$this->privateClose(); 
			
			return $flag;
		}

		function getSingleString($NameTable, $targetColName, &$targetValue, $ColName, $ColValue){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
        

	        $ColNameSheilded = $this->db->screening($ColName);
	        $ColValueSheilded = $this->db->screening($ColValue);
	        $targetColNameSheilded = $this->db->screening($targetColName);
	      
            $query = "SELECT `$targetColNameSheilded` FROM `$NameTableSheilded` WHERE `$ColNameSheilded` = '{$ColValueSheilded}'";
		    $this->db->run($query); //при передаче пустого запроса err ==''

            if(!$this->db->getError())
            {
                $num_rows = $this->db->num_rows();
                if($num_rows !== 0)
	            {
	             	if($num_rows === 1)
	            	{   
	                	$targetValue = $this->db->row(0);
	                	
	                	$flag = 0;//
	                } else {
	                	$flag = 3;//в таблице несколько строк `$ColName`=`$ColValue`
	                }
	                
	            } else {
	                $flag = 2;// в колнке нет такого значения 
	            }
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
	         
			$this->privateClose(); 

			return $flag;
		}
		*/
		/*
			Особые случаи пробрасываются выше
			проверка типизации должна быть выше
			если записи с таким значением нет, то ничего непроисходит, можнос сделать чтоб 2 возвращалось		
		*//*
		function updateString($NameTable, $Cols_Values, $ColName, $ColValue){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);
			if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
	        

			$ColNameSheilded = $this->db->screening($ColName);
	        $ColValueSheilded = $this->db->screening($ColValue);
	        //'{$ColValueSheilded}'
            $n = count($Cols_Values);
            $query = "UPDATE `$NameTableSheilded` SET";
            
            for($i=0; $i < $n - 1; $i++){
            	$ColVal = $this->db->screening($Cols_Values[$i]['value']);
            	$query .= " " . $this->db->screening($Cols_Values[$i]['name']) . " = '{$ColVal}',";
            }
            $ColVal = $this->db->screening($Cols_Values[$n - 1]['value']);
            $query .= " " . $this->db->screening($Cols_Values[$n - 1]['name']) . " = '{$ColVal}'";
			$query .= " WHERE " . $ColNameSheilded . " =  '{$ColValueSheilded}'";
		
		    $this->db->run($query); //при передаче пустого запроса err ==''
		    if(!$this->db->getError())
            {	
            	$flag = 0; 
            } else {
                $flag = $this->db->getError();//непонятное исключение
            } 
			$this->privateClose(); 
			
			return $flag;	
		}

		/*
			Особые случаи пробрасываются выше
			проверка типизации должна быть выше
		*/
			/*
		function setString($NameTable, $Cols_Values){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);    
	        
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;

            $n = count($Cols_Values);
            $query = "INSERT INTO `$NameTableSheilded` (";
            
            for($i=0; $i < $n - 1 ; $i++){
            	$query .= $this->db->screening($Cols_Values[$i]['name']) . ", ";//"(site, description) values ('sitear.ru', 'SiteAR – создание сайтов')";
            }
			$query .= $this->db->screening($Cols_Values[$i]['name']) . ") values (";//"(site, description) values ('sitear.ru', 'SiteAR – создание сайтов')";
            
            for($i=0; $i < $n - 1 ; $i++){
            	$ColVal = $this->db->screening($Cols_Values[$i]['value']);
            	$query .= "'{$ColVal}', ";//"(site, description) values ('sitear.ru', 'SiteAR – создание сайтов')";
            }
			$ColVal = $this->db->screening($Cols_Values[$n - 1]['value']);
			$query .= "'{$ColVal}')";//"(site, description) values ('sitear.ru', 'SiteAR – создание сайтов')";
            
		    $this->db->run($query); //при передаче пустого запроса err ==''

            if(!$this->db->getError())
            {
            	$flag = 0; 
            } else {
                $flag = $this->db->getError();//непонятное исключение
            } 
			$this->privateClose(); 
			
			return $flag;	
		}

		function setBlockStrings($NameTable, $Cols_Values){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);    
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
        

            $n = count($Cols_Values);
            $query = "INSERT INTO `$NameTableSheilded` (";
            
            for($i=0; $i < $n - 1 ; $i++){
            	$query .= $this->db->screening($Cols_Values[$i]['name']) . ", ";//"(site, description) values ('sitear.ru', 'SiteAR – создание сайтов')";
            }
			$query .= $this->db->screening($Cols_Values[$i]['name']) . ") values";

			$m = count($Cols_Values[$i]['values']);
			for ($j=0; $j < $m; $j++) { 
				$record = " ("; 
	            for($i=0; $i < $n - 1 ; $i++){
	            	$ColVal = $this->db->screening($Cols_Values[$i]['values'][$j]);
                	$record .= "'{$ColVal}', ";
	            }
		      	$ColVal = $this->db->screening($Cols_Values[$n - 1]['values'][$j]);
				$record .= "'{$ColVal}')";
				
				$query .= $record;
				if($j < $m - 1)
					$query .= ", ";
			}

			//echo $query;
			
		    $this->db->run($query); //при передаче пустого запроса err ==''

            if(!$this->db->getError())
            {
            	$flag = 0; 
            } else {
                $flag = $this->db->getError();//непонятное исключение
            } 
			$this->privateClose(); 
			
			return $flag;	
		}

		/*
			Особые случаи пробрасываются выше
			проверка типизации должна быть выше
		*/
			/*
		function getDataByCriterion($NameTable, &$targetCols, $criterionCols = false, $order = false){
			$this->connect();
			$NameTableSheilded = $this->db->screening($NameTable);
	         
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
	        
            $numTarCols = count($targetCols);
            $tarColsSheilded = "";
            for ($i=0; $i < $numTarCols - 1; $i++) { 
            	$TNC = $this->db->screening($targetCols[$i]['name']);
        		$tarColsSheilded .= "`$TNC`, ";
        	}	
        	$TNC = $this->db->screening($targetCols[$numTarCols - 1]['name']);
        	$tarColsSheilded .= "`$TNC`";
			
			$CritColsSheilded = "";
			if($criterionCols) {
				$numCritCols = count($criterionCols);
		        
		        $CritColsSheilded .= " WHERE ";
		        for ($i=0; $i < $numCritCols; $i++) { 
		        	$CNC = $this->db->screening($criterionCols[$i]['name']);
		    		$CritColsSheilded .= "(";
		    		
		    		$ColVal = $this->db->screening($criterionCols[$i]['values'][0]);
					$valuesCrit = "`$CNC` = '{$ColVal}'" ;
		    		$m = count($criterionCols[$i]['values']);	
		    		for ($j=1; $j < $m; $j++) { 
		    			$ColVal = $this->db->screening($criterionCols[$i]['values'][$j]);
		    			$valuesCrit .= " OR `$CNC` = '{$ColVal}'";
		    		}	
		    		$CritColsSheilded .= $valuesCrit . ")";
		    		if($i < ($numCritCols - 1))
		    			$CritColsSheilded .= " AND ";
		    	}
			}
			$query = "SELECT ".$tarColsSheilded." FROM `$NameTableSheilded`";
			 
			$query .= $CritColsSheilded;
			if($order) {//!order
				$orderBy = " ORDER BY " . $this->db->screening($order);
				$query .= $orderBy;	//ORDER BY column1, column2, ... ASC|DESC;
			}
			$query .= ";";
			//echo $query;
            
		    $this->db->run($query); //при передаче пустого запроса err ==''

			    
            if(!$this->db->getError())
            {
                $num_rows = $this->db->num_rows();
                if($num_rows !== 0)
	            {
	            	for ($i=0; $i < $num_rows; $i++) { 
	            		$rows = $this->db->row($i);
	            		for ($j=0; $j < $numTarCols; $j++) { 
	            			$targetCols[$j]['values'][$i] = $rows[$targetCols[$j]['name']];
	            		}		
	            	}
	            	$flag = 0;
	            } else {
	                $flag = 2;// в колнке нет такого значения 
	            }
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
		         
			$this->privateClose(); 

			return $flag;
		}
				
		function run($query) {
			$this->connect(); 
			//$this->db->run($query);
			if(!$this->db->getError())
			{
			    return $result; 
			} else {
			    echo $this->db->getError();
			}
			$this->privateClose(); 
		}
	

		/*
			Приватная функция
		*/	/*
		function addUniqueKey($NameTable,$Cols) {
			$this->connect();
			
			$NameTableSheilded = $this->db->screening($NameTable);
			
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;
			
			$nameKey = $this->db->screening($Cols['name_key']);
  		 	
  		 	//if(!$this->checkKeyToTableIsExistance($NameTableSheilded,$nameKey,false))	return 2;
	        
	        
  		    $query = "ALTER TABLE `$NameTableSheilded` ADD UNIQUE $nameKey(";
	        
  		    for($i = 0; $i < count($Cols); ++$i) {
  		    	$query .= $this->db->screening($Cols['names'][$i]);	
		        
        		if($i < count($Cols)-1) {
	    			$query .= ",";
	    		} else {
	    			$query .= ")";;
	    		}
		    }

			echo "|".$query."|";

			$this->db->run($query); //при передаче пустого запроса err ==''
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
	         
			$this->privateClose(); 
			return $flag;
		}

		function addReferences($NameTable,$Cols) {
			$this->connect();
			
			$NameTableSheilded = $this->db->screening($NameTable);
			
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;
			
	       	$query = "ALTER TABLE `$NameTableSheilded`";
	        
  		    for($i = 0; $i < count($Cols); ++$i) {
  		    	$nameCol = $this->db->screening($Cols[$i]['name']);
  		    	$nameKey = $this->db->screening($Cols[$i]['name_key']);
    	 		$RefTable = $this->db->screening($Cols[$i]['TableRef']);
	    		$RefCol = $this->db->screening($Cols[$i]['ColRef']);
		        $TypeDeleteRefCol = $this->createTypeRef($Cols[$i]['typeDelete']);
	    		$TypeUpdateRefCol = $this->createTypeRef($Cols[$i]['typeUpdate']);
	    		
		        $query .= " ADD ( CONSTRAINT $nameKey FOREIGN KEY(".$nameCol.") REFERENCES $RefTable(".$RefCol.")";
	    		$query .=  " ON DELETE ".$TypeDeleteRefCol." ";
				$query .=  " ON UPDATE ".$TypeUpdateRefCol." ";
        		
        		if($i < count($Cols)-1) {
	    			$query .= ",";
	    		} else {
	    			$query .= ")";;
	    		}
		    }
           			    
		
			//echo "|".$query."|";

			$this->db->run($query); //при передаче пустого запроса err ==''
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
	         
			$this->privateClose(); 
			return $flag;
		}


		function deleteReferences($NameTable,$Cols) {
			$this->connect();
			
			$NameTableSheilded = $this->db->screening($NameTable);
			
	        if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;

	       	$query = "ALTER TABLE `$NameTableSheilded`";
	        
  		    for($i = 0; $i < count($Cols); ++$i) {
  		    	$nameCol = $this->db->screening($Cols[$i]['name_key']);
    	 		
		        $query .= " DROP FOREIGN KEY $nameCol";
        		if($i < count($Cols)-1) {
	    			$query .= ",";
	    		} 
		    }
           			    
		
			//echo "|".$query."|";

			$this->db->run($query); //при передаче пустого запроса err ==''
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
	         
			$this->privateClose(); 
			return $flag;
		}

		function createQueryLine($Cols,$i){
			//Возможна уязвимость???
			//NOT NULL , UNIQUE , DEFAULT ,    dt-n-u-d

	        $nameCol = $this->db->screening($Cols[$i]['name']);
	        $query = $nameCol. " ";

			$ColType = $this->db->screening($Cols[$i]["type"]);
			$Default = $ColType % 10;
			$ColType = ($ColType - $Default) / 10;
			$Unique = $ColType % 10;
			$ColType = ($ColType - $Unique) / 10;
			$NotNull = $ColType % 10;
			
			$ColType = ($ColType - $NotNull) / 10;
			$DataType = $ColType;
			
			$NotNullVal = "";
			if($NotNull == 1) { 
				$NotNullVal = " NOT NULL";//[DEFAULT default_value] 
			}

			$UniqueVal = "";
			if($Unique == 1) { 
				$UniqueVal = " UNIQUE";//[DEFAULT default_value] 
			}

			$DefaultVal = "";
			if($Default == 1) {
				$DefVal = $Cols[$i]["default_value"];
				$DefaultVal = " DEFAULT $DefVal";//[DEFAULT default_value] 
			}
			
	        switch ($DataType) {
	            case 10:  $TypeCol = "INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY";    break;
	            case 11:  $un = ($Cols[$i]["uns"] ? " UNSIGNED" : "");  $TypeCol = "INT".$un;    break;
	            case 12:  $TypeCol = "DATETIME";    break;
	            case 13:  $TypeCol = "DATE";    break;
	            case 14:  $lv = $Cols[$i]["length"];  $TypeCol = "VARCHAR($lv)";    break;	            
	            case 15:  $lv = $Cols[$i]["length"];  $TypeCol = "TEXT($lv)";    break;
	        }
	        $query .= " ".$TypeCol.$NotNullVal.$UniqueVal.$DefaultVal;
	    	
	        return $query;
	    }
		
		function createTypeRef($type){
			//Возможна уязвимость???
	        switch ($this->db->screening($type)) {
	            case 0:  $typeRef = "RESTRICT";    break;
	            case 1:  $typeRef = "CASCADE";    break;
	            case 2:  $typeRef = "SET NULL";    break;
	            case 3:  $typeRef = "NO ACTION";    break;
	            case 4:  $typeRef = "SET DEFAULT";    break;
	        }
	        return $typeRef;
	    }

		/*
			Особые случаи пробрасываются выше
		*//*
		function create($NameTable, $Cols) {
			$this->connect();
			
			$NameTableSheilded = $this->db->screening($NameTable);
			
	        if(!$this->checkTableIsExistance($NameTableSheilded,false))	return 1; //more flexible variant
	        
	        $num_refs = 0;
	        for($i = 0; $i < count($Cols); ++$i) {
		        if($Cols[$i]['ref']) {
		        	$num_refs++;
		        }
		    }
            $query = "CREATE TABLE IF NOT EXISTS `$NameTableSheilded` (";
		    
            for($i = 0; $i < count($Cols) - 1 ; ++$i) {
		        $query .=$this->createQueryLine($Cols,$i). ",\n";
		    }
			$i = count($Cols) - 1;
			$query .= $this->createQueryLine($Cols,$i);
		    
            if($num_refs > 0) { 
			    $query .= ",\n";
			    //FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
			    $j = 0;
			    for($i = 0; $i < count($Cols); ++$i) {
			    	if($Cols[$i]['ref']) {
			    		$j++;
			    		$nameCol = $Cols[$i]['name'];
			    		$nameRefTable = $Cols[$i]['TableRef'];
			    		$nameRefCol = $Cols[$i]['ColRef'];
			    		$TypeDeleteRefCol = $this->createTypeRef($Cols[$i]['typeDelete']);
			    		$TypeUpdateRefCol = $this->createTypeRef($Cols[$i]['typeUpdate']);
			    		$foreign = "FOREIGN KEY (`$nameCol`) REFERENCES `$nameRefTable`(`$nameRefCol`)\n";
			    		$foreign .=  "ON DELETE ".$TypeDeleteRefCol."\n";
						$foreign .=  "ON UPDATE ".$TypeUpdateRefCol."\n";

			    		$query .= $foreign;
			    		if($j < $num_refs) {
			    			$query .= ",\n";
			    		} else {
			    			$query .= "\n";
			    		}

			    	}
			    }
			}
			else 
			{	
				$query .= "\n";
			}

		    
			$query .= ")";

			//echo $query;

			$this->db->run($query); //при передаче пустого запроса err ==''
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
	         
			$this->privateClose(); 
			return $flag;
		}

/*
		function createIndex($NameTable, $Cols) {
			$this->connect();
			
			$NameTableSheilded = $this->db->screening($NameTable);
			
	        if(!$this->checkTableIsExistance($NameTableSheilded,false))	return 1;
	        
	        $num_refs = 0;
	        for($i = 0; $i < count($Cols); ++$i) {
		        if($Cols[$i]['ref']) {
		        	$num_refs++;
		        }
		    }
            $query = "CREATE TABLE `$NameTableSheilded` (";
		    
            for($i = 0; $i < count($Cols) - 1 ; ++$i) {
		        $query .=$this->createQueryLine($Cols,$i). ",\n";
		    }
			$i = count($Cols) - 1;
			$query .= $this->createQueryLine($Cols,$i);
		    
            if($num_refs > 0) { 
			    $query .= ",\n";
			    //FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
			    $j = 0;
			    for($i = 0; $i < count($Cols) - 1 ; ++$i) {
			    	if($Cols[$i]['ref']) {
			    		$j++;
			    		$nameCol = $Cols[$i]['name'];
			    		$nameRefTable = $Cols[$i]['nameTableReference'];
			    		$nameRefCol = $Cols[$i]['nameColReference'];
			    		$TypeDeleteRefCol = $this->createTypeRef($Cols[$i]['typeDelete']);
			    		$TypeUpdateRefCol = $this->createTypeRef($Cols[$i]['typeUpdate']);
			    		$foreign = "FOREIGN KEY (`$nameCol`) REFERENCES `$nameRefTable`(`$nameRefCol`)\n";
			    		$foreign .=  "ON DELETE ".$TypeDeleteRefCol."\n";
						$foreign .=  "ON UPDATE ".$TypeUpdateRefCol."\n";

			    		$query .= $foreign;
			    		if($j < $num_refs) {
			    			$query .= ",\n";
			    		} else {
			    			$query .= "\n";
			    		}

			    	}
			    }
			}
			else 
			{	
				$query .= "\n";
			}

		    
			$query .= ")";

			echo $query;

			$this->db->run($query); //при передаче пустого запроса err ==''
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();//непонятное исключение
            }
	         
			$this->privateClose(); 
			return $flag;
		}
*/


		/*
			Особые случаи пробрасываются выше
			если записи с таким значением нет, то ничего непроисходит
		*//*
		function deleteRecord($nameTable,$Col) {
			$this->connect();
			$NameTableSheilded = $this->db->screening($nameTable);
			if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
         	

			$ColNameSheilded = $this->db->screening($Col['name']);
	        $ColValueSheilded = $this->db->screening($Col['value']);
	        
            $query = "DELETE FROM `$NameTableSheilded` WHERE `$ColNameSheilded` = '{$ColValueSheilded}'";
            $this->db->run($query);
               
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();// в каком случае?
            }
	         
			$this->privateClose(); 
        
	        return $flag;
		}

		/*
			Особые случаи пробрасываются выше
		*//*
		function deleteTable($nameTable) {
			$this->connect();
			$NameTableSheilded = $this->db->screening($nameTable);
			if(!$this->checkTableIsExistance($NameTableSheilded))	return 1;    
        			
	       
            $query = "DROP TABLE `$NameTableSheilded`";
            $this->db->run($query);
            if(!$this->db->getError())
            {
                $flag = 0;
            } else {
                $flag = $this->db->getError();// в каком случае?
            }
	         
			$this->privateClose(); 
        
	        return $flag;
		}*/

	}

?>