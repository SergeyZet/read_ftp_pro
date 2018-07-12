<?php
   // require_once 'Tables/All/CreateRealize/libTables.php';
    
    /*
        $user[""]

    */
    //Двойная проверка на email
    function addUser($user) {
        require_once 'Tables/All/CreateRealize/libTables.php';

        $db = new MyDB();             
        $db->connect();
        $tableUser = new TableUsers(2,$db);

        $error = $tableUser->addUser($user);        
        if($error["code_error"] !== 0) {
            $result["id"] = -1;
            $result["code_error"] = $error["code_error"];
            $result["reason"] = $error["reason"];
            
            return $result;   
        }

        $error = $tableUser->getId($user['email'],$id);
        $db->close();
        if($error !== 0) {
            $result["id"] = -1;
            $result["code_error"] = 500;
            $result["reason"] = "server";
            
            return $result;   
        }
        $result["id"] = $id;
        
        return $result;
    }    

    function changeUser($user) {
        require_once 'Tables/All/CreateRealize/libTables.php';

        $db = new MyDB();             
        $db->connect();
        $tableUser = new TableUsers(2,$db);

        $error = $tableUser->changeUser($user);        
        if($error !== 0) {
            echo "ERROR: ". $error . "; ";    
        }
        else
        {
            echo "User was changed succsessfully; ";  
        }
        $db->close();
        
        return $id;
    }

    //Сделать, чтоб не всё выводилось, а только то, что нужно
    function getDataUser(&$user,$id) {
        require_once 'Tables/All/CreateRealize/libTables.php';

        $db = new MyDB();             
        $db->connect();
        $tableUser = new TableUsers(2,$db);

        $error = $tableUser->getUser($user,$id);        
        if($error !== 0) {
            echo "ERROR: ". $error . "; ";    
        }
        else
        {
            echo "User was gotten succsessfully; ";  
        }
        $db->close();
        
        return $id;
    }    

    //расширить до login :)
    function checkPassUser($pass,$email,&$valid) {
        require_once 'Tables/All/CreateRealize/libTables.php';

        if(!isset($pass)) {
            $valid = false;
            return;
        }
        $db = new MyDB();             
        $db->connect();
        $tableUser = new TableUsers(2,$db);

        $user['email'] = $email;
        $user['password'] = $pass;
        
        $error = $tableUser->checkPass($user,$valid);        
        if($error["code_error"] !== 0) {
            return $error;    
        }
        $db->close();
        
        return $id;
    }





/*
    $example['description']['replicas']
    $example['description']['help']
    $example['description']['name']
            
    $example['elementary_examples'][$i]['replicas']
    $example['elementary_examples'][$i]['help']
    $example['elementary_examples'][$i]['name']
    $example['elementary_examples'][$i]['theme']
    $example['elementary_examples'][$i]['specific']

*/



    function Sieve($mas){
        $proxymas[0] = $mas[0];
        $idTEE;
        $k = 0;
        for ($i=0; $i < count($mas); $i++) { 
            $key = $mas[$i];
            for ($j = $i + 1; $j < count($mas); $j++) { 
                if($key === $mas[$i]) {            
                    $proxymas[$j] = null;
                } else {
                    $proxymas[$j] = $mas[$i];
                }
            }

            if(isset($proxymas[$i])) {
                $idTEE[$k] = $proxymas[$i];
                $k++;
            }
        }
        return $idTEE;
    }

    function GetIndex($mas,$value){
        for ($i=0; $i < count($mas); $i++) { 
            if($value === $mas[$i]) {
                return $i;
            }
        }
        return null;
    }

    // доработать на случай повторяющихся упражнений в уроке
    // может вернуть данный только по одному example
    function getExample($idUser,$ExampleToLesson,&$example) {
        require_once 'Tables/All/CreateRealize/libTables.php';

        /*
        if(isset($idExample)) {
            $example = false;
            return;
        }*/
        $db = new MyDB();             
        $db->connect();
        
        $tableUsers = new TableUsers(2,$db);
        //сделать проверку
       

        //Получить id example по номеру в уроке
        $TableLessons = new TableStructuresLessons(2,$db);
        $error = $TableLessons->GetIdExample($ExampleToLesson,$idExample); //ready to test
        if($error !== 0) {
            echo "TableStructuresLessons)ERROR: ". $error . "; ";
            $db->close();    
            return $error;   
        }
        //Получить информацию по example
        $tableExamples = new TableExamples(2,$db);
        $error = $tableExamples->GetTypeIdExample($idExample,$idTypeExa); //можно брать ещё и имя   //ready to test
        if($error !== 0) {
            echo "TableExamples) ERROR: ". $error . "; ";
            $db->close();     
            return $error;   
        }
        $tableTExa = new TableTypesExamples(2,$db);
        $error = $tableTExa->GetDescriptionById($idTypeExa,$typeExa);//ready to test
        if($error !== 0) {
            echo "TableTypesExamples) ERROR: ". $error . "; ";
            $db->close();     
            return $error;   
        }
        $example['description']['replicas'] = $typeExa['speech_character'];
        $example['description']['help'] = $typeExa['path_to_help'];
        $example['description']['name'] = $typeExa['name'];
       


        $tableTRefElemWithExa = new TableRefElemExaWithExamples(2,$db);
        $error = $tableTRefElemWithExa->GetElemExaToExa($idExample,$idElemExamples);//уже отсортированы  //ready to test      
        if($error !== 0) {
            echo "TableRefElemExaWithExamples) ERROR: ". $error . "; ";
            $db->close();     
            return $error;   
        }
        $tableElemExample = new TableElementaryExamples(2,$db);
        $error = $tableElemExample->GetTypesElemExa($idElemExamples,$idTypeElemExa);//хранит и id, и их типы в том порядке, что был на входе //ready to test 
        /*
        $idTypeElemExa['id'][$i]
        $idTypeElemExa['id_type'][$i]
        */
        if($error !== 0) {
            echo "TableElementaryExamples) ERROR: ". $error . "; ";
            $db->close();
            return $error;
        }   
        $proxymas = $idTypeElemExa['id_type'];
        $idTEE = Sieve($proxymas);// нет повторяющихся
        $tableTypeElemExample = new TableTypesElementaryExamples(2,$db);
        $ContentByIdTypeEE;
        $error = $tableTypeElemExample->GetContents($idTEE,$ContentByIdTypeEE);//содержит и id, и content в том порядке, что был на входе//ready to test 
        /*
        $ContentByIdTypeEE['id'][$i]
        $ContentByIdTypeEE['content'][$i]
        $ContentByIdTypeEE['id_theme'][$i]
        */
        if($error !== 0) {
            echo "TableTypesElementaryExamples) ERROR: ". $error . "; ";
            $db->close();     
            return $error;   
        }
        $proxymas = $ContentByIdTypeEE['id_theme'];
        $idThemes = Sieve($proxymas);// нет повторяющихся
        $tableThemesExamples = new TableThemesExamples(2,$db);
        $error = $tableThemesExamples->GetThemes($idThemes,$Themes);//содержит и id, и themes в том порядке, что был на входе//ready to test 
        if($error !== 0) {
            echo "ERROR: ". $error . "; ";
            $db->close();     
            return $error;   
        }
        /*
        $Themes['id'][$i]
        $Themes['themes'][$i]
        */
        //заполнение темами
        for($i=0; $i < count($ContentByIdTypeEE['content']); $i++) {
            $k = GetIndex($Themes['id'],$ContentByIdTypeEE['id_theme'][$i]);
            if(!isset($k)) {
                return -1;//ошибка сервера не хватает данных
            }
            $ContentByIdTypeEE['content'][$i]['theme'] = $Themes['themes'][$k];
        }
        

        $proxymas = $ContentByIdTypeEE['id_structure'];
        $idStructures = Sieve($proxymas);// нет повторяющихся
        $tableStrucuresEE = new TableStructuresTablesEE(2,$db);
        $error = $tableStrucuresEE->GetStructures($idStructures,$Structures);//содержит и id, и strucures в том порядке, что был на входе//ready to test 
        if($error !== 0) {
            echo "ERROR(TableStructuresTablesEE): ". $error . "; ";
            $db->close();
            return $error;   
        }
        /*
        $Structures['id'][$i]
        $Structures['number_raitings'][$i];
        $Structures['number_intervals'][$i];   
        */
        //заполнение темами
        
        for($i=0; $i < count($ContentByIdTypeEE['content']); $i++) {
            $k = GetIndex($Structures['id'],$ContentByIdTypeEE['id_structure'][$i]);
            if(!isset($k)) {
                return -1;//ошибка сервера не хватает данных
            }
            $ContentByIdTypeEE['content'][$i]['number_raitings'] = $Structures['number_raitings'][$k];
            $ContentByIdTypeEE['content'][$i]['number_intervals'] = $Structures['number_intervals'][$k];           
        }


        //можно оптимизировать
        for($i=0; $i < count($ContentByIdTypeEE['id']); $i++) {
            $tableElemExampleByType = new TableElemExaByTypesId($ContentByIdTypeEE['id'][$i],2,$db);
            $strucure['number_raitings'] = $ContentByIdTypeEE['content'][$i]['number_raitings'];
            $strucure['number_intervals'] = $ContentByIdTypeEE['content'][$i]['number_intervals'];
            
            $error = $tableElemExampleByType->GetContentEEById($idElemExamples[$i],$strucure,$ElemExamples);//пока получает по одному упражнению, возможно делая несколько запросов к одной таблице;      а также возвращает лишь спифику ee 
            if($error !== 0) {
                echo "TableElemExaByTypesId) ERROR: ". $error . "; ";
                $db->close();     
                return $error;   
            }
            $ContentByIdTypeEE['content'][$i]['specificity'] = $ElemExamples['specificity'];
            $ContentByIdTypeEE['content'][$i]['type_specificity'] = $ContentByIdTypeEE['id'][$i];
        }


        //заполнение $examples
        for($i=0; $i < count($idTypeElemExa['id_type']); $i++) {
            $k = GetIndex($ContentByIdTypeEE['id'],$idTypeElemExa['id_type'][$i]);
            if(!isset($k)) {
                return -2;//ошибка сервера не хватает данных
            }
            $example['elementary_examples'][$i] = $ContentByIdTypeEE['content'][$k];
        }
        $db->close();
        
        return $id;
    }     

    function setExample($example,&$idExample) {
        require_once 'Tables/All/CreateRealize/libTables.php';

        if(!isset($idExample)) {
            $example = false;
            return;
        }

        $db = new MyDB();             
        $db->connect();
        
        $tableUsers = new TableUsers(2,$db);
        //сделать проверку

        $TableLessons = new TableStructuresLessons(2,$db);
        
        $error = $TableLessons->GetIdExample($ExampleToLesson,$idExa);

        $user['email'] = $email;
        $user['password'] = $pass;
        
        $tableExamples = new TableExamples(2,$db);

        $error = $TableExamples->GetTypeIdExample($idExa,$idTypeExa);

        $tableTExa = new TableTypesExamples(2,$db);
        $error = $tableTExa->GetTypeById($idTypeExa,$typeExa);

        $tableTRefElemWithExa = new TableRefElemExaWithExamples(2,$db);
        $error = $tableTRefElemWithExa->GetElemExamples($idExample,$BaseElemExamples);        
        
        
        $tableElemExample = new TableElemExa(2,$db);
        $error = $tableElemExample->GetTypesElemExa($idElemExamples,$idTypeElemExa);
        
        for($i=0; $i < count($idTypeElemExa); $i++) {
            $tableElemExampleByType = new TableElemExaByTypesId($idTypeElemExa[$i]['id_type'],2,$db);
            $error = $tableElemExampleByType->GetElemExampleById($idElemExamoles,$ElemExamples);
            $nameKey = 'soderganieParts' . $i;  
            $examples[$nameKey] = $ElemExamples;
        }

        
        if($error !== 0) {
            echo "ERROR: ". $error . "; ";    
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        $db->close();
        
        return $id;
    }

    function setElementaryExample($ElemExample,&$idElemExa) {
        require_once 'Tables/All/CreateRealize/libTables.php';
        
        if(!isset($idExample)) {
            $example = false;
            return;
        }
        
        $db = new MyDB();             
        $db->connect();
        
        $tableUsers = new TableUsers(2,$db);
        //сделать проверку
        
        $TableLessons = new TableLessons(2,$db);
        
        $error = $TableLessons->GetIdExample($ExampleToLesson,$idExa);

        $user['email'] = $email;
        $user['password'] = $pass;
        
        $tableExamples = new TableExamples(2,$db);

        $error = $TableExamples->GetTypeIdExample($idExa,$idTypeExa);
        $tableTExa = new TableTypesExamples(2,$db);
        $error = $tableTExa->GetTypeById($idTypeExa,$typeExa);

        $tableTRefElemWithExa = new TableRefElemExaWithExamples(2,$db);
        $error = $tableTRefElemWithExa->GetElemExamples($idExample,$BaseElemExamples);        
        
        
        $tableElemExample = new TableElemExa(2,$db);
        $error = $tableElemExample->GetTypesElemExa($idElemExamples,$idTypeElemExa);
        
        for($i=0; $i < count($idTypeElemExa); $i++) {
            $tableElemExampleByType = new TableElemExaByTypesId($idTypeElemExa[$i]['id_type'],2,$db);
            $error = $tableElemExampleByType->GetElemExampleById($idElemExamoles,$ElemExamples);
            $nameKey = 'soderganieParts' . $i;  
            $examples[$nameKey] = $ElemExamples;
        }

        
        if($error !== 0) {
            echo "ERROR: ". $error . "; ";    
        }
        else
        {
            echo "User was checked succsessfully; ";  
        }
        $db->close();
        
        return $id;
    }


    function GetNamesELemExaSpec(&$namesCols,$type){
        $tableElemExampleByType = new TableElemExaByTypesId($type,2);
        $error = $tableElemExampleByType->GetNameColls($namesCols);
        return $error;           
    }
?>