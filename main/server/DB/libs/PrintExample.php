<?php
    require_once 'libBD.php';
    
    $example;
    $ExampleToLesson['number_lesson'] = 1;
	$ExampleToLesson['number_example'] = 1;
	echo "!".getExample($idUser,$ExampleToLesson,$example)."!";

	
	echo "!!".json_encode($example)."!!";	

	/*echo "Речь персонажа: [";
	for ($i=0; $i < count($example['description']['replicas']); $i++) { 
		echo $example['description']['replicas'][$i];
		if($i != count($example['description']['replicas']) - 1)	echo "; ";
	}
	echo "] |";

	echo "Подсказка: ". $example['description']['help'] . " |";
    echo "Название: ". $example['description']['name'] . " |";
   	$n = count($example['elementary_examples']);
   	echo "Число элементарных заданий: ". $n . "; | [";    

	    
	for ($i=0; $i < $n; $i++) { 
	    $elem_exa = $example['elementary_examples'][$i];
	    echo "Номер элементарного задания: ". ($i+1) . "; |";

	    echo "Тема: ". $elem_exa['theme'] . "; |";	
		
		$m = count($elem_exa['replicas']);
		echo "Речь персонажа: [";
		for ($j=0; $j < $m; $j++) { 
			echo $elem_exa['replicas'][$j];
			if($j != $m - 1)	echo "; ";
		}
		echo "] |";

		echo "Подсказка: ". $elem_exa['help'] . " |";
    
    	echo "Название: ". $elem_exa['specificity']['name']  . " |";
    
        
	    echo "Time intervals: ". $elem_exa['number_intervals'] . "[";
		for ($j=0; $j < $elem_exa['number_intervals']; $j++) { 
			echo "min_time_bad_$j : " . $elem_exa['specificity']['min_time_bad_'.$j] . ",";
			echo "max_time_bad_$j : " . $elem_exa['specificity']['max_time_bad_'.$j] . ",";
			echo "min_time_fishily_$j : " . $elem_exa['specificity']['min_time_fishily_'.$j] . ",";
			echo "max_time_fishily_$j : " . $elem_exa['specificity']['max_time_fishily_'.$j];
			
			if($j != $elem_exa['number_intervals'] - 1) echo "; ";
		}
		echo "] |";

	    echo "Number raitings: ". $elem_exa['number_raitings'] . "[";
		for ($j=0; $j < $elem_exa['number_raitings']; $j++) { 
			echo "rating_quality_$j : " . $elem_exa['specificity']['rating_quality_'.$j];
			
			if($j != $elem_exa['number_raitings'] - 1) echo "; ";
		}
		echo "] |";
		GetNamesELemExaSpec($namesCols,$elem_exa['type_specificity']);
		for ($j=0; $j < count($namesCols); $j++) { 
			echo $namesCols[$j] . ": " . $elem_exa['specificity'][$namesCols[$j]] . "; ";			
		}


		echo "Number of type specificity: ". $elem_exa['type_specificity'];
		echo "Name of type specificity: ". $elem_exa['name_type'];
	
		if($i != $n - 1)	echo "; ";
	}
	echo "] |";*/
?>