<?php
	require_once 'BasePoint.php';
	

	class TableHistoryUsersByTypesStructureElemExaId
	{
	
		var $db;	
		var $openConnect;
		var $NameTable;
		var $TypeId;
		function __construct($IdTypeStrucureExa, $openConnect = 0, $db = false){
			$this->NameTable = 'Table_History_Users_By_Types_Structure_Elem_Exa_' . $IdTypeStrucureExa; 
			$this->openConnect = $openConnect;
			$this->TypeId = $IdTypeStrucureExa;
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
		function create($ConfigurationTypeTable){
			$this->connect();

			if($ConfigurationTypeTable['id_table'] !== $TypeId) {
				return 2;
			}
			//Basics:
			//id_example -> id_lesson
			//id_elementary_example -> number_example_to_lesson
			// для привязки к уроку, но что делать с доп заданиями?
			$Cols = array (  
		    	array  ( 'name' => 'id_user', 'type' => 11100, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Users',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		    	array  ( 'name' => 'id_elementary_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Elementary_Examples',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		    	array  ( 'name' => 'id_example', 'type' => 11100, 'uns' => true, 'ref' => 1,
		    						'ColRef' => 'id',
                                  	'TableRef' => 'Table_Examples',
                                  	'typeDelete' => 1,
                                  	'typeUpdate' => 1
		    			),
		    	array  ( 'name' => 'date_time_attempt', 'type' => 12100, 'ref' => 0),
		    );			

			for($i = 0; $i < $ConfigurationTypeTable['number_time_intervals']; $i++) {
				$Cols[count($Cols)] = array  ( 'name' => ('time_perfomance_' + $i), 'type' => 11100, 'uns' => true, 'ref' => 0);	
			}
			
			for($i = 0; $i < $ConfigurationTypeTable['number_ratings_quality']; $i++) {
				$Cols[count($Cols)] = array  ( 'name' => ('quality_performance' + $i), 'type' => 11100, 'uns' => false, 'ref' => 0);
			}


		    $flag = $this->db->create($this->NameTable,$Cols);
		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Создание таблицы (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") уже существует";

				else echo $flag;
			*/
		}


		/*
			Only comments
		*/
		function insertNewExe($numberExe, $themeExe, $roleExe){
			$this->connect();	
			
			$Cols = array ( 
		        //array  ( 'name' => 'id_example', 'value' => 0),
		        array  ( 'name' => 'number_exesize', 'value' => $numberExe),
		        array  ( 'name' => 'number_attempts', 'value' => 0),
		        array  ( 'name' => 'time_min', 'value' => 0),
		        array  ( 'name' => 'time_max', 'value' => 0),
		        array  ( 'name' => 'time_mid', 'value' => 0),
		        array  ( 'name' => 'time_second_moment', 'value' => 0),
		        array  ( 'name' => 'additional_intervals_time', 'value' => ''),
		        array  ( 'name' => 'first_time', 'value' => 0),
		       	array  ( 'name' => 'quality_performance', 'value' => 0),
		        array  ( 'name' => 'data_last_attempt', 'value' => 0),
		        array  ( 'name' => 'status_exesize', 'value' => 0),
		        array  ( 'name' => 'theme_exesize', 'value' => $themeExe),
		    	array  ( 'name' => 'role_exesize', 'value' => $roleExe),
		    );
		
		    $flag = $this->db->setString($NameTable,$Cols);

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}

/*
	таблица упражнений
	таблица пользователей
	таблицы связанные с группой
	...
	таблица упражнений пользователя
	таблица статистике для каждого упражнения и пользователя

*/

		/*
			2 мерный массив с целыми индексами
			0 - 'idName'
			1 - 'theme_exesize'
			2 - 'role_exesize'
			
			Only comments
		*/
		function insertNewBlockExe($Exesizes){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			$Cols = array ( 
		        //array  ( 'name' => 'id_example', 'value' => 0),
		       	0 => array  ( 'name' => 'number_exesize', 'values' => $numberExe),
		       	1 => array  ( 'name' => 'number_attempts', 'values' => $numberAtt),
		       	2 => array  ( 'name' => 'time_min', 'values' => $timeMin),
		       	3 => array  ( 'name' => 'time_max', 'values' => $timeMax),
		       	4 => array  ( 'name' => 'time_mid', 'values' => $timeMid),
		       	5 => array  ( 'name' => 'time_second_moment', 'values' => $timeSecondM),
		       	6 => array  ( 'name' => 'additional_intervals_time', 'values' => $timeAddInter),
		       	7 => array  ( 'name' => 'first_time', 'values' => $timeF),
		       	8 => array  ( 'name' => 'quality_performance', 'values' => $qualityPer),
		       	9 => array  ( 'name' => 'data_last_attempt', 'values' => $dataLastAtt),
		       	10 => array  ( 'name' => 'status_exesize', 'values' => $statusExe),
		       	11 => array  ( 'name' => 'theme_exesize', 'values' => $themeExe),
		    	12 => array  ( 'name' => 'role_exesize', 'values' => $roleExe),	
		    );

			
			$n = count($Exesizes[0]);
			
			for ($i=1; $i < 10; $i++) { 
				for ($j=1; $j < $n; $j++) { 
					$Cols[$i]['values'][$j] = 0;
				}
			}
			for ($i=0; $i < $n; $i++) { 
				$Cols[0]['values'][$i] = $Exesizes[0][$i];
				$Cols[6]['values'][$i] = '';
				$Cols[11]['values'][$i] = $Exesizes[1][$i];
				$Cols[12]['values'][$i] = $Exesizes[2][$i];
			}

		    $flag = $this->db->setBlockStrings($NameTable,$Cols);

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}

		/*
			Only comments
		*/
		function updateDateExesize($idExe, $timeExe, $TimeIntervals, $qualityPerform, $dataExe){
			$this->connect();	
			
			$flag = $this->db->getAllFromString($NameTable,$StringsValues,'number_exesize',$idExe);

			$i = 0;
			if ($timeExe < $StringsValues['time_min']) {
				$Cols[$i] = array ( 'name' => 'time_min', 'value' => $timeExe);
				$i++;
			} 

			if ($timeExe > $StringsValues['time_max']) {
				$Cols[$i] = array ( 'name' => 'time_max', 'value' => $timeExe);
				$i++;
			}
			if($StringsValues['quality_performance'] < $qualityPerform) {
 				// как-то отсеивать плохие резултаты выполнения -10 - 'это 10 ошибок' +5 - 'это баллы за задания'
 				$Cols[$i] = array ( 'name' => 'quality_performance', 'value' => $qualityPerform);
				$i++;
 			}

			$Cols[$i] = array ( 'name' => 'data_last_attempt', 'value' => $dataExe);
			$i++;
			$numberAtt = $StringsValues['number_attempts'];
			$time1 = $StringsValues['time_mid'] * $numberAtt;
			$timeMid = ($time1 + $timeExe)/($numberAtt + 1);
			$Cols[$i] = array ( 'name' => 'time_mid', 'value' => $timeMid);
			$i++;
 			$time2 = $StringsValues['time_second_moment'] * $numberAtt;
			$timeSecondM = ($time2 + $timeExe*$timeExe)/($numberAtt + 1);
			$Cols[$i] = array ( 'name' => 'time_second_moment', 'value' => $timeSecondM);
 			$i++;
 			$numberAtt++;
			$Cols[$i] = array ( 'name' => 'number_attempts', 'value' => $numberAtt);
 			$i++;
 			
			$timeInter = explode(" ", $StringsValues['quality_performance']);
			$timeInter = handler_time_inter_exe($idExe,$timeInter,$timeIntervals);			
			$timeInterText = $timeInter[0];
			for ($j=1; $j < count($timeInter); $j++) { 
				$timeInterText .= ' '. $timeInter[$i];
			}

			$Cols[$i] = array  ( 'name' => 'additional_intervals_time', 'value' => $timeInterText);
	
		    $flag = $this->db->updateString($NameTable, $Cols,'number_exesize', $idExe);

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}


		/*
			Only comments
		*/
		function updateFirstStatus($idExe,$timeExe, $TimeIntervals, $qualityPerform,$statusExe,$dataExe){
			$this->connect();	

			$timeInterText = $TimeIntervals[0];
			for ($j=1; $j < count($timeInter); $j++) { 
				$timeInterText .= ' '. $timeInter[$i];
			}
			$Cols = array ( 
		        //array  ( 'name' => 'id_example', 'value' => 0),
		       	1 => array  ( 'name' => 'number_attempts', 'value' => 1),
		       	2 => array  ( 'name' => 'time_min', 'value' => $timeExe),
		       	3 => array  ( 'name' => 'time_max', 'value' => $timeExe),
		       	4 => array  ( 'name' => 'time_mid', 'value' => $timeExe),
		       	5 => array  ( 'name' => 'time_second_moment', 'value' => $timeExe*$timeExe),
		       	6 => array  ( 'name' => 'additional_intervals_time', 'value' => $timeInterText),
		       	7 => array  ( 'name' => 'first_time', 'value' => $timeExe),
		       	8 => array  ( 'name' => 'quality_performance', 'value' => $qualityPer),
		       	9 => array  ( 'name' => 'data_last_attempt', 'value' => $dataExe),
		       	10 => array  ( 'name' => 'status_exesize', 'value' => $statusExe),    	
		    );


		    $flag = $this->db->updateString($NameTable, $Cols,'number_exesize', $idExe);

		 	$this->close();
		 	return $flag;   
			/*
				$flag === 0 :	echo "Внесение данных в таблицу (".$NameTable.") прошло успешно";
				$flag === 1 :	echo "Таблица(".$NameTable.") не существует";

				else echo $flag;
			*/
		}



/*
		доделать это:
*/

		function getAll($values, $controlPoint = 3){
			$this->connect();	
			
			//$flag = $this->db->countRecords($NameTable, $count);

			// Критерии
			$Cols = array ( 
		        -1 => array  ( 'name' => 'id_example', 'value' => 0),
		       	0 => array  ( 'name' => 'number_exesize', 'values' => $numberExe),
		       	8 => array  ( 'name' => 'data_last_attempt', 'values' => $dataLastAtt),
		       	9 => array  ( 'name' => 'status_exesize', 'values' => $statusExe),
		       	10 => array  ( 'name' => 'theme_exesize', 'values' => $themeExe),
		    	11 => array  ( 'name' => 'role_exesize', 'values' => $roleExe),	
		    );

			//Запрос для хранилища
			

			$ColsCrit = array ( 
		       	0 => array  ( 'name' => 'status_exesize', 'value' => $statusExe),
		       	1 => array  ( 'name' => 'theme_exesize', 'value' => $themeExe),
		    	//2 => array  ( 'name' => 'role_exesize', 'value' => $roleExe),	
		    );

			//Запрос для хранилища
			$ColsTag = array ( 
		        array ( 'name' => 'id_example', 'type' => 0),
		        array ( 'name' => 'number_exesize', 'type' => 2),
		        //array ( 'name' => 'number_attempts', 'type' => 2),
		        //array ( 'name' => 'time_max', 'type' => 2),
		        //array ( 'name' => 'time_mid', 'type' => 2),
		        //array ( 'name' => 'first_time', 'type' => 2),
		       	//array ( 'name' => 'quality_performance', 'type' => 0),
		        //array ( 'name' => 'data_last_attempt', 'type' => 3),
		        //array ( 'name' => 'status_exesize', 'type' => 2),
		        //array ( 'name' => 'theme_exesize', 'type' => 2),
		        array ( 'name' => 'role_exesize', 'type' => 2),
		    );



			//Запрос для занятия
			$ColsCrit = array ( 
		       	0 => array ( 'name' => 'number_exesize', 'type' => 2),
		       	//0 => array ( 'name' => 'id_example', 'value' => 0),
		       	//1 => array ( 'name' => 'status_exesize', 'value' => $statusExe),
		    );

			//Запрос для занятия
			$ColsTag = array ( 
		        array ( 'name' => 'number_exesize', 'values' => 2),
		        //array ( 'name' => 'number_attempts', 'values' => 2),
		        array ( 'name' => 'data_last_attempt', 'type' => 3),
		        //array ( 'name' => 'first_time', 'values' => 2),
		       	array ( 'name' => 'quality_performance', 'values' => 0),
		        array ( 'name' => 'status_exesize', 'values' => 2),
		        array ( 'name' => 'theme_exesize', 'values' => 2),
		        array ( 'name' => 'role_exesize', 'values' => 2),
		    );

			//Запрос для учителя таблица 1
			$ColsCrit = array ( 
		     	//array ( 'name' => 'id_example', 'values' => 0),
		        
		     	0 => array ( 'name' => 'number_exesize', 'type' => 2),
		        1 => array ( 'name' => 'status_exesize', 'value' => $statusExe),
		       	2 => array ( 'name' => 'theme_exesize', 'value' => $themeExe),
		    	//2 => array  ( 'name' => 'role_exesize', 'value' => $roleExe),	
		    );

			//Запрос для учителя таблица 1
			$ColsTag = array ( 
		        array ( 'name' => 'additional_intervals_time', 'values' => $timeAddInter),
		       	array ( 'name' => 'quality_performance', 'type' => 0),
		        array ( 'name' => 'role_exesize', 'type' => 2),
		    );


			//Запрос для учителя таблица 2
			$ColsCrit = array (
				//array ( 'name' => 'id_example', 'values' => 0), 
		     	0 => array ( 'name' => 'number_exesize', 'type' => 2),
		        1 => array ( 'name' => 'status_exesize', 'value' => $statusExe),	
		    );

			//Запрос для учителя таблица 2
			$ColsTag = array ( 
				array ( 'name' => 'time_max', 'type' => 2),
				array ( 'name' => 'first_time', 'values' => 2),
		        array ( 'name' => 'additional_intervals_time', 'values' => $timeAddInter),
		       	array ( 'name' => 'quality_performance', 'type' => 0),
		        array ( 'name' => 'role_exesize', 'type' => 2),
		    );

			//Запрос для учителя таблица 3

		    // Цели
			$Cols = array ( 
		        array ( 'name' => 'id_example', 'type' => 0),
		        array ( 'name' => 'number_exesize', 'type' => 2),
		        array ( 'name' => 'status_exesize', 'type' => 2),
		        array ( 'name' => 'theme_exesize', 'type' => 2),
		        array ( 'name' => 'role_exesize', 'type' => 2),
		    );

			//Запрос для учителя таблица 3
			$targetCols = array ( 
		  	//      array  ( 'name' => 'number_attempt', 'value' => 0),                
				array ( 'name' => 'number_attempts', 'type' => 2),
		        array ( 'name' => 'time_max', 'type' => 2),
		        array ( 'name' => 'time_second_moment', 'type' => 2),
		        array ( 'name' => 'additional_intervals_time', 'type' => 1),
		       	array ( 'name' => 'quality_performance', 'type' => 0),
		        array ( 'name' => 'data_last_attempt', 'type' => 3),
		        array ( 'name' => 'status_exesize', 'type' => 2),
		        array ( 'name' => 'theme_exesize', 'type' => 2),
		        array ( 'name' => 'role_exesize', 'type' => 2),
		    );
		
			//Запрос для графика к каждому упражнению
			//Запрос для диаграммы выполнения заданий по темам всех упражнений мб таблица 1
				


			switch ($controlPoint) {
				case 1:
					$targetCols[2] = array('name' => 'control_point', 'values' => $values);

					$flag = $this->db->getDataByCriterion($NameTable,$targetCols);
					break;
				case 2:
					$criterionCols = array ( 
			        	array  ( 'name' => 'control_point', 'value' => 1),
			    	);	
			    	$flag = $this->db->getDataByCriterion($NameTable,$targetCols,$criterionCols);
					break;	
				case 3:
					$targetCols[2] = array('name' => 'control_point', 'values' => $values);
					
					$criterionCols = array ( 
			        	array  ( 'name' => 'valid_attempt', 'value' => $values),
			    	);
					$flag = $this->db->getDataByCriterion($NameTable,$targetCols,$criterionCols);
					break;
				
				default:
					$flag = 3; //не тот режим
					break;
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