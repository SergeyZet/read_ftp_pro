<?php    
    function InitTables($db){
        require_once 'Tables/All/CreateRealize/libTables.php';

        //zero lvl
        $Tables[0]['name'] = 'TableTypesRewards'; 
        $Tables[0]['class'] = new TableTypesRewards(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableThemesExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableThemesExamples(2,$db);         
        $Tables[count($Tables)]['name'] = 'TableUsersRoles'; 
        $Tables[count($Tables)-1]['class'] = new TableUsersRoles(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableRanksUsers'; 
        $Tables[count($Tables)-1]['class'] = new TableRanksUsers(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableCities'; 
        $Tables[count($Tables)-1]['class'] = new TableCities(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableGroups'; 
        $Tables[count($Tables)-1]['class'] = new TableGroups(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableRolesExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableRolesExamples(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableStructuresTablesEE'; 
        $Tables[count($Tables)-1]['class'] = new TableStructuresTablesEE(2,$db); 
        //complex
        $Tables[count($Tables)]['name'] = 'TableAvatars';
        $Tables[count($Tables)-1]['class'] = new TableAvatars(2,$db); 
 
        //one lvl
        
        $Tables[count($Tables)]['name'] = 'TableRewardsByRaitingsQuality'; 
        $Tables[count($Tables)-1]['class'] = new TableRewardsByRaitingsQuality(2,$db); 
        
        $Tables[count($Tables)]['name'] = 'TableTypesElementaryExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableTypesElementaryExamples(2,$db); 
        
        $Tables[count($Tables)]['name'] = 'TableUsers'; 
        $Tables[count($Tables)-1]['class'] = new TableUsers(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableTypesExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableTypesExamples(2,$db); 
        

        //two lvl
        $Tables[count($Tables)]['name'] = 'TableElementaryExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableElementaryExamples(2,$db);  
        $Tables[count($Tables)]['name'] = 'TableExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableExamples(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableGroupsRolesUsers'; 
        $Tables[count($Tables)-1]['class'] = new TableGroupsRolesUsers(2,$db); 
        
        //three lvl
        $Tables[count($Tables)]['name'] = 'TableRefElemExaWithExamples'; 
        $Tables[count($Tables)-1]['class'] = new TableRefElemExaWithExamples(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableStructuresLessons'; 
        $Tables[count($Tables)-1]['class'] = new TableStructuresLessons(2,$db);
        

                /*
        //three lvl many 
        $Tables[count($Tables)]['name'] = 'TableElemExaByTypesId'; 
        $Tables[count($Tables)]['class'] = new TableElemExaByTypesId(2,$db); 
        $Tables[count($Tables)]['name'] = 'TableHistoryUsersByTypesStructureElemExaId'; 
        $Tables[count($Tables)]['class'] = new TableHistoryUsersByTypesStructureElemExaId(2,$db); 
        */
        return $Tables;
    }


    //мб переделать create для EEById
    // $Tables[0]['config'] = $config;// исключить в случае передачи по ссылке
        
    function InitTablesExamples($db){
        require_once 'Tables/All/CreateRealize/libTables.php';

        

        $config['name_table_id'] = '1';
        $config['number_time_intervals'] = 2;
        $config['number_ratings_quality'] = 0;
        $Tables[0]['name'] = 'Table_Elementary_Examples_type_'.$config['name_table_id']; 
        $Tables[0]['class'] = new TableElemExaByTypesId($config['name_table_id'],2,$db);
        $Tables[0]['config'] = $config;
        
        $config['name_table_id'] = '2';
        $config['number_time_intervals'] = 0;
        $config['number_ratings_quality'] = 1;
        $Tables[1]['name'] = 'Table_Elementary_Examples_type_'.$config['name_table_id']; 
        $Tables[1]['class'] = new TableElemExaByTypesId($config['name_table_id'],2,$db);         
        $Tables[1]['config'] = $config;
        
        $config['name_table_id'] = '3';
        $config['number_time_intervals'] = 1;
        $config['number_ratings_quality'] = 0;
        $Tables[2]['name'] = 'Table_Elementary_Examples_type_'.$config['name_table_id']; 
        $Tables[2]['class'] = new TableElemExaByTypesId($config['name_table_id'],2,$db);         
        $Tables[2]['config'] = $config;

        $config['name_table_id'] = '4';
        $config['number_time_intervals'] = 1;
        $config['number_ratings_quality'] = 1; 
        $Tables[3]['name'] = 'Table_Elementary_Examples_type_'.$config['name_table_id']; 
        $Tables[3]['class'] = new TableElemExaByTypesId($config['name_table_id'],2,$db);         
        $Tables[3]['config'] = $config;

        $config['name_table_id'] = '5';
        $config['number_time_intervals'] = 3;
        $config['number_ratings_quality'] = 1; 
        $Tables[4]['name'] = 'Table_Elementary_Examples_type_'.$config['name_table_id']; 
        $Tables[4]['class'] = new TableElemExaByTypesId($config['name_table_id'],2,$db);         
        $Tables[4]['config'] = $config;
        
        $config['name_table_id'] = '7';
        $config['number_time_intervals'] = 2;
        $config['number_ratings_quality'] = 0; 
        $Tables[5]['name'] = 'Table_Elementary_Examples_type_'.$config['name_table_id']; 
        $Tables[5]['class'] = new TableElemExaByTypesId($config['name_table_id'],2,$db);         
        $Tables[5]['config'] = $config;
        
        return $Tables;
    }

    function InitTablesExamplesForDelete($db){
        require_once 'Tables/All/CreateRealize/libTables.php';

        $Tables[0]['name'] = 'Table_Elementary_Examples_type_1'; 
        $Tables[0]['class'] = new TableElemExaByTypesId(1,2,$db);
        
        $Tables[1]['name'] = 'Table_Elementary_Examples_type_2'; 
        $Tables[1]['class'] = new TableElemExaByTypesId(2,2,$db);         
        
        $Tables[2]['name'] = 'Table_Elementary_Examples_type_3'; 
        $Tables[2]['class'] = new TableElemExaByTypesId(3,2,$db);         
        
        $Tables[3]['name'] = 'Table_Elementary_Examples_type_4'; 
        $Tables[3]['class'] = new TableElemExaByTypesId(4,2,$db);         
        
        $Tables[4]['name'] = 'Table_Elementary_Examples_type_5'; 
        $Tables[4]['class'] = new TableElemExaByTypesId(5,2,$db);         
    
        $Tables[5]['name'] = 'Table_Elementary_Examples_type_7'; 
        $Tables[5]['class'] = new TableElemExaByTypesId(7,2,$db);         

        return $Tables;
    }

    
    function deleteTables(&$Tables){
        require_once 'Tables/All/CreateRealize/libTables.php';
        for($i = count($Tables) - 1; $i >= 0; $i--){    
            if($Tables[$i]['name'] === 'TableAvatars'){
                echo $Tables[$i]['class']->deleteReferences();
            }
            echo "|$i|";
        }

        for($i = count($Tables) - 1; $i >= 0; $i--){
            /*if($Tables[$i]['name'] === 'TableAvatars'){
                $tag = $i;
            }*/

            $flag = $Tables[$i]['class']->delete();
            if($flag === 0) {
                echo $Tables[$i]['name']."succsessfully!";
            } else {
                echo $Tables[$i]['name'].$flag;
            }
        }
    }

    function CreateTables(&$Tables){
        require_once 'Tables/All/CreateRealize/libTables.php';

        $tag = 0;
        for($i = 0; $i < count($Tables); $i++){
            $flag;
            $j;

            for($j = 1; $j <= 7; $j++){      
                if($Tables[$i]['name'] === ('Table_Elementary_Examples_type_'.$j)) {
                    $flag = $Tables[$i]['class']->create($Tables[$i]['config']);
                    $j = 1000;
                }
            }
            if($j < 1000) {
                $flag = $Tables[$i]['class']->create();    
            }

            if($flag !== 0 && $flag !== 1) {
                echo "|ERROR:Table " . $Tables[$i]['name'] . " was do not made($flag) |";
            } else {
                //echo "Table " . $Tables[$i]['name'] . " was made succsessfully ($flag) |";
            }

            if($Tables[$i]['name'] === 'TableAvatars'){
                $tag = $i;
            }
            if($Tables[$i]['name'] === 'TableUsers') {
                $flag = $Tables[$tag]['class']->addReferences();
                //echo "|".$flag."|";
            }

        }
    }
    
    function CreateTablesExamplesToBD() {
        require_once 'Tables/All/CreateRealize/libTables.php';

        $db = new MyDB();             
        $db->connect();
        $Tables = InitTablesExamples($db);
        CreateTables($Tables);
        $db->close();
        
        echo "All Tables were made succsessfully";   
        //echo $flag;
    }

    //ключи и индексы нужно сделать проверку на существование
    function CreateTablesToBD() {
        require_once 'Tables/All/CreateRealize/libTables.php';

        $db = new MyDB();             
        $db->connect();
        $Tables = InitTables($db);
        //deleteTables($Tables);
        //$flag = $Tables[1]['class']->create();
        CreateTables($Tables);
        $db->close();
        
        echo "All Tables were created succsessfully";    
        //echo $flag;
    }

    function deleteTablesToBD() {
        echo "All";    
        require_once 'Tables/All/CreateRealize/libTables.php';
        
        $db = new MyDB();             
        $db->connect(); 
        deleteTables(InitTablesExamplesForDelete($db));
        deleteTables(InitTables($db));
        
        //$flag = $Tables[1]['class']->create();
        //CreateTables($Tables);
        $db->close();
        
        echo "All Tables were deleted succsessfully";    
        //echo $flag;
    }


    //ОЧЕНЬ ХРУПКАЯ версия функции доделать и переделать

    
    function InintElementaryExamples(&$ContentTypeEE,&$Structures) {
        $db = new MyDB();             
        $db->connect();
       
        $ElemExa;
        
        for( $i = 0 ; $i < count($ContentTypeEE) ; $i++) {
            $ElemExa[$i]['id_type'] = $ContentTypeEE[$i]['id'];
            $ElemExa[$i]['name_table_id'] = $ContentTypeEE[$i]['name'];
        }

        $tableElemExample = new TableElementaryExamples(2,$db);
        $error = $tableElemExample->SetElemExa($ElemExa);
        if($error !== 0 && $error !== 2) {
            echo "ERROR(TableElementaryExamples): ". $error . "; ";    
            for ($i=0; $i < count($ElemExa); $i++) { 
                echo "|" . "id = ".$ElemExa[$i]['id'] . "id_type = ".$ElemExa[$i]['id_type'] . "|";
                # code...
            }
            //return;
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }

        $ElemExamples;
        //Не создает для 7
        //Base
        for($i=0; $i < count($ElemExa); $i++) {
            $ElemExamples[$i]['id_e_e'] = $ElemExa[$i]['id'];
            for($j = 0; $j < $Structures[$i]['number_intervals']; $j++) {
                $nameKey = 'min_time_bad_'.$j;            
                $ElemExamples[$i][$nameKey] = 100;
                $nameKey = 'max_time_bad_'.$j;
                $ElemExamples[$i][$nameKey] = 20*60*100;
                $nameKey = 'min_time_fishily_'.$j;
                $ElemExamples[$i][$nameKey] = 10*100;
                $nameKey = 'max_time_fishily_'.$j;
                $ElemExamples[$i][$nameKey] = 10*60*100;
            }
            for($j = 0; $j < $Structures[$i]['number_raitings']; $j++) {
                $nameKey = 'rating_quality_'.$j;
                $ElemExamples[$i][$nameKey] = 3;
            }
        }
        $ElemExamples[0]['name'] = 'Однобуквенные';
        $ElemExamples[1]['name'] = 'По три слова';
        $ElemExamples[2]['name'] = '5 букв в слове';
        $ElemExamples[3]['name'] = 'Символы';
        $ElemExamples[4]['name'] = 'Текст с вопросами';
        $ElemExamples[5]['name'] = 'Цитата';
        //Specific
        $ElemExamples[0]['specificity']['path_to_file_picture'] = 'example1/prompt/popup.jpg';
        $ElemExamples[1]['specificity']['words'] = 'арбуз | дыня | ананас ';
        $ElemExamples[2]['specificity']['word'] = 'кровь';
        $ElemExamples[3]['specificity']['number_calc_vertical'] = 4;
        $ElemExamples[3]['specificity']['number_calc_gorizontal'] = 4;
        $ElemExamples[3]['specificity']['number_pictures'] = 3;
        $ElemExamples[4]['specificity']['text'] = 'Erhtj ergrthr thrrjk[[pkew, km[pm[pr em[n[w[g [kkk ef[pgr [pmag.';
        $ElemExamples[4]['specificity']['questions'] = '123 ^ & 13 % &12 &12|123 ^ & 13 % &12 &12|123 ^ & 13 % &12 &12';
        $ElemExamples[5]['specificity']['picture_1'] = 'example7/content/id_1_number_1.png';
        $ElemExamples[5]['specificity']['picture_2'] = 'example7/content/id_1_number_2.png';
        
        for($i=0; $i < count($ElemExa); $i++) {
            $tableElemExampleByType = new TableElemExaByTypesId($ElemExa[$i]['name_table_id'],2,$db);
            $error = $tableElemExampleByType->SetElemExa($ElemExamples[$i],$Structures[$i]);
            if($error !== 0 && $error !== 2) {
               echo "ERROR(TableElemExaByTypesId): ". $error . "; ";    
               //return;
            }
            else
            {
                echo "User was checked succsessfully; ";  
            }
        }

        $db->close();

        return $ElemExa;
    }

    function InintExamples(&$typeExample,&$ElemExa) {
        $db = new MyDB();             
        $db->connect();
        
        $Examples;
        for($i = 0; $i < 6; $i++) {
            $Examples[$i]['id_type'] = $typeExample[$i]['id'];
        }

        $Examples[0]['name'] = '1';
        $Examples[1]['name'] = '2';
        $Examples[2]['name'] = '3';
        $Examples[3]['name'] = '4';  
        $Examples[4]['name'] = '5';
        $Examples[5]['name'] = '7';
        
        $tableExamples = new TableExamples(2,$db);
        $error = $tableExamples->SetExamples($Examples);
        if($error !== 0 && $error !== 2) {
           echo "ERROR(TableExamples): ". $error . "; "; 
           //return;   
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        //for($i = 0; $i < 5; $i++) $Examples[$i]['id'] = $i + 1;

        for($i = 0; $i < 6; $i++) {
            $RefElemExamples[$i]['id_example'] = $Examples[$i]['id'];
            $RefElemExamples[$i]['id_elementary_example'] = $ElemExa[$i]['id'];
            $RefElemExamples[$i]['number'] = 0;
        }
        
        
        $tableTRefElemWithExa = new TableRefElemExaWithExamples(2,$db);
        $error = $tableTRefElemWithExa->SetExamples($RefElemExamples);        
        if($error !== 0 && $error !== 2) {
            echo "ERROR(TableRefElemExaWithExamples): ". $error . "; ";
           //return;
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        
        $db->close();

        return $Examples;
    }   

    function InintLessons(&$Examples,&$Roles) {
        $db = new MyDB();             
        $db->connect();
        
        for ($i=0; $i < 6; $i++) { 
            $Lessons[$i]['id_example'] = $Examples[$i]['id'];
            $Lessons[$i]['number_lesson'] = 1;
            $Lessons[$i]['number_example'] = $i + 1;
            $Lessons[$i]['role_example'] = $Roles[0]['id'];       
        }
        $TableLessons = new TableStructuresLessons(2,$db);
        $error = $TableLessons->SetLessons($Lessons);
        if($error !== 0 && $error !== 2) {
            echo "ERROR(TableStructuresLessons): ". $error . "; ";   
            //return; 
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }        $db->close();

        return $Lessons;
    }   



    function InitStartVersion(){
        require_once 'Tables/All/CreateRealize/libTables.php';
/*
        if(!isset($idExample)) {
            $example = false;
            return;
        }
        
        
        $tableUsers = new TableUsers(2,$db);
        //можно сделать проверку
        
        
        $user['email'] = $email;
        $user['password'] = $pass;
        */
        
        $db = new MyDB();             
        $db->connect();
        
        
        $Themes[0]['theme'] = 'Артикуляция';
        $Themes[1]['theme'] = 'Внимание';
        $Themes[2]['theme'] = 'Скорость мышления';
        $Themes[3]['theme'] = 'Память';
        $Themes[4]['theme'] = 'Скорость чтения';
        //for ($i=0; $i < count($Themes); $i++) $Themes[$i]['id'] = $i+1; 
        
        $tableThemesExamples = new TableThemesExamples(2,$db);
        $error = $tableThemesExamples->SetThemes($Themes);//содержит и id, и themes в том порядке, что был на входе//ready to test 
        
        if($error !== 0 && $error !== 2) {
           echo "ERROR(TableThemesExamples): ". $error . "; ";   
           //return; 
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        
        $Structures[0]['number_intervals'] = 2;
        $Structures[0]['number_raitings'] = 0;
        $Structures[1]['number_intervals'] = 0;
        $Structures[1]['number_raitings'] = 1;
        $Structures[2]['number_intervals'] = 1;
        $Structures[2]['number_raitings'] = 0;
        $Structures[3]['number_intervals'] = 1;
        $Structures[3]['number_raitings'] = 1;
        $Structures[4]['number_intervals'] = 3;
        $Structures[4]['number_raitings'] = 1;
        
        //for ($i=0; $i < count($Structures); $i++) $Structures[$i]['id'] = $i+1;

        $tableStructuresTablesEE = new TableStructuresTablesEE(2,$db);
        $error = $tableStructuresTablesEE->SetStructures($Structures);
        if($error !== 0 && $error !== 2) {
           echo "ERROR(TableStructuresTablesEE): ". $error . "; ";   
           //return; 
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }

        $ContentTypeEE[0]['replicas'] = '321|234|345'; 
        $ContentTypeEE[0]['id_structures'] = $Structures[0]['id'];
        $ContentTypeEE[0]['name'] = '1';//'Алфавит';
        $ContentTypeEE[0]['help'] = 'typeEE//1';
        $ContentTypeEE[0]['id_theme'] = $Themes[0]['id'];
        
        $ContentTypeEE[1]['replicas'] = '123|234|345';
        $ContentTypeEE[1]['id_structures'] = $Structures[1]['id'];
        $ContentTypeEE[1]['name'] = '2';//'Слова';
        $ContentTypeEE[1]['help'] = 'typeEE//2';
        $ContentTypeEE[1]['id_theme'] = $Themes[1]['id'];
        
        $ContentTypeEE[2]['replicas'] = '123|234|345';
        $ContentTypeEE[2]['id_structures'] = $Structures[2]['id'];
        $ContentTypeEE[2]['name'] = '3';//'Буквы';
        $ContentTypeEE[2]['help'] = 'typeEE//3';
        $ContentTypeEE[2]['id_theme'] = $Themes[2]['id'];
        
        $ContentTypeEE[3]['replicas'] = '123|234|345';
        $ContentTypeEE[3]['id_structures'] = $Structures[3]['id'];
        $ContentTypeEE[3]['name'] = '4';//'Картинки и Символы';
        $ContentTypeEE[3]['help'] = 'typeEE//4';
        $ContentTypeEE[3]['id_theme'] = $Themes[3]['id'];
              
        $ContentTypeEE[4]['replicas'] = '123|234|345';
        $ContentTypeEE[4]['id_structures'] = $Structures[4]['id'];
        $ContentTypeEE[4]['name'] = '5';//'Текст и тест';
        $ContentTypeEE[4]['help'] = 'typeEE//5';
        $ContentTypeEE[4]['id_theme'] = $Themes[4]['id'];
        
        $ContentTypeEE[5]['replicas'] = '123|234|345';
        $ContentTypeEE[5]['id_structures'] = $Structures[0]['id'];
        $ContentTypeEE[5]['name'] = '7';//'Цитата';
        $ContentTypeEE[5]['help'] = 'example7/prompt/popup.jpg';
        $ContentTypeEE[5]['id_theme'] = $Themes[4]['id'];
        
        //for ($i=0; $i < count($ContentTypeEE); $i++) $ContentTypeEE[$i]['id'] = $i+1;
        
        $tableTypeElemExample = new TableTypesElementaryExamples(2,$db);
        $error = $tableTypeElemExample->SetTypes($ContentTypeEE);//содержит и id, и content в том порядке, что был на входе//ready to test 
        if($error !== 0 && $error !== 2) {
            echo "ERROR(TableTypesElementaryExamples): ".$error. "; ";    
            //return;
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        
        /*Создать таблицы под новые типы*/
        
        $ElemExa = InintElementaryExamples($ContentTypeEE,$Structures);
        
        $typesRewards[0]['name'] = 'Money';
        $typesRewards[1]['name'] = 'Energy';
        
        $tableTypesRewards = new TableTypesRewards(2,$db);
        $error = $tableTypesRewards->SetTypes($typesRewards);
        if($error !== 0 && $error !== 2) {
           echo "ERROR(TableTypesRewards): ". $error . "; "; 
           //return;   
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        
        //for ($i=0; $i < count($typesRewards); $i++) $typesRewards[$i]['id'] = $i + 1; 

        $typeExample[0]['name'] = '1';
        $typeExample[0]['replicas'] = '123|123';
        $typeExample[0]['help'] = 'фыв';
        $typeExample[0]['id_type_reward'] = $typesRewards[0]['id'];
        
        $typeExample[1]['name'] = '2';
        $typeExample[1]['replicas'] = '123|123';
        $typeExample[1]['help'] = 'фыв';
        $typeExample[1]['id_type_reward'] = $typesRewards[0]['id'];

        $typeExample[2]['name'] = '3';
        $typeExample[2]['replicas'] = '123|123';
        $typeExample[2]['help'] = 'фыв';
        $typeExample[2]['id_type_reward'] = $typesRewards[0]['id'];

        $typeExample[3]['name'] = '4';
        $typeExample[3]['replicas'] = '123|123';
        $typeExample[3]['help'] = 'фыв';
        $typeExample[3]['id_type_reward'] = $typesRewards[0]['id'];

        $typeExample[4]['name'] = '5';
        $typeExample[4]['replicas'] = '123|123';
        $typeExample[4]['help'] = 'фыв';
        $typeExample[4]['id_type_reward'] = $typesRewards[1]['id'];

        $typeExample[5]['name'] = '6';
        $typeExample[5]['replicas'] = '123|123';
        $typeExample[5]['help'] = 'фыв';
        $typeExample[5]['id_type_reward'] = $typesRewards[0]['id'];


        $tableTExa = new TableTypesExamples(2,$db);
        $error = $tableTExa->SetTypes($typeExample);
        if($error !== 0 && $error !== 2) {
           echo "ERROR(TableTypesExamples): ". $error . "; "; 
           //if($error === 2) $tableTExa->GetTypeElemExampleByName($name,&$ContentTEE);
           //return;   
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        //for($i = 0; $i < 5; $i++) $typeExample[$i]['id'] = $i + 1;
        
        $Examples = InintExamples($typeExample,$ElemExa);
        
        
        $Roles[0]['name'] = 'Main';
        $Roles[1]['name'] = 'Additional';

        $tableRolesExamples = new TableRolesExamples(2,$db);
        $error = $tableRolesExamples->Set($Roles);        
        if($error !== 0 && $error !== 2) {
           echo "ERROR(TableRolesExamples): ". $error . "; ";  
           //return;  
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        //for ($i=0; $i < 2; $i++) $Roles[$i]['id'] = $i + 1;
            
        $Lessons = InintLessons($Examples,$Roles);
        $db->close();
    }

?>