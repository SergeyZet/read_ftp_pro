<?php
    //require_once '..//Tables//All//CreateRealize//libTables.php'; //ругается
    require_once '..//Tables//All//CreateRealize//Base//SimpleSQLClass.php';
    require_once '..//Tables//All//CreateRealize//TableProba.php'; //ругается

    echo "1";
    $db = new MyDB();
echo "2";
$db->connect();
echo "3";
$Table = new TableProba(1,$db);
echo "4";
$Table->delete();
$db->close();
    echo "success";
?>