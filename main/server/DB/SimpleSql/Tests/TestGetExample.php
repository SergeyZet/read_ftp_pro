<?php
    require_once 'libBD.php';

	//CreateTablesToBD();


    $email = 'pupkin@vasia19.ru';
    $pass = 'awdawd123wqe';

	$ExampleToLesson['number_lesson'] = 1;
	$ExampleToLesson['number_example'] = 1;

	getExample(1,$ExampleToLesson,$example);

	$replicas='';
	for ($j=0; $j < count($example['description']['replicas']); $j++) { 
	 	$replicas .= $example['description']['replicas'][$j] .", ";
	} 
	echo "Упражнение:	реплики: ".$replicas.";					";
	echo "Упражнение:	местоположение подсказки: ".$example['description']['help'].";				";
	$val = $example['description']['name'];
	if(isset($val) && !empty($val))
		echo "Упражнение:	Название упражнения: ".$val.";				";
	
	for ($i=0; $i < count($example['elementary_examples']); $i++) {
		$replicas='';
		for ($j=0; $j < count($example['elementary_examples'][$i]['replicas']); $j++) { 
		 	$replicas .= $example['elementary_examples'][$i]['replicas'][$j] .", ";
		} 
		echo "Элементарное упражнение($i):	реплики: ".$replicas.";				";
		echo "Элементарное упражнение($i):	местоположение подсказки: ".$example['elementary_examples'][$i]['help'].";	";
		echo "Элементарное упражнение($i):	Название типа упражнения: ".$example['elementary_examples'][$i]['name_type'].";";
		echo "Элементарное упражнение($i):	тема упражнения: ".$example['elementary_examples'][$i]['theme'].";			";
		echo "Элементарное упражнение($i):	тип спецификации: ".$example['elementary_examples'][$i]['type_specificity'].";			";
	}
	
	$example['elementary_examples'][$i]['specificity'];	
?>