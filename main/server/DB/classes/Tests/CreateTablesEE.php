<?php
    //require_once '..//Tables//All//CreateRealize//libTables.php'; //ругается
    echo "0";
 
    require_once '..//CreateRealize//Base//SimpleSQLClass.php';
 	echo "00";
    require_once '..//CreateRealize//examples//TableProba.php'; //ругается
/*	
	function includeFiles($dir){
        $dh  = opendir('..//classes//CreateRealize//$dir');
        while ($filename = readdir($dh)) {
            if(!is_dir($filename)) {
                include_once($filename);
            }
        }
    }
    includeFiles('examples');
*/
    echo "12";
    $db = new MyDB();
	echo "2";
	$db->connect();
	echo "3";
	$Table = new TableProba(1,$db);
	echo "4";
	$Table->create();
	$db->close();
    echo "success";
?>