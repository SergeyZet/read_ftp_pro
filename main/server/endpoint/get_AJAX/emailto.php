<?php
require_once ("../../system_lib_class/sendEmail.php");
$json = json_decode($_POST['json']);
$send = new SenderEmails($json->name,$json->phone,$json->email,$json->coment);
$send->send();
$send->get_result();
//print_r($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['coment']);
?>
