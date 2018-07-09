 <?php
	//мб в case сделать переменные устанавливаемые при create
	class FactoryTablesById
	{
		function __construct(){
		}

		function GetTable($TypeId){
			$table;
			switch ($TypeId) {
				case 1:
						$table = new ClassTableId_1();		
					break;
				case 2:
						$table = new ClassTableId_2();
					break;
				case 3:
						$table = new ClassTableId_3();
					break;
				case 4:
						$table = new ClassTableId_4();
					break;
				case 5:
						$table = new ClassTableId_5();
					break;
				case 7:
						$table = new ClassTableId_7();
					break;
				default:
						$table = null;
					break;
			}
			return $table;
		}
	}
?>