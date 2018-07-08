<?php
require_once ("../../system_lib_class/sendEmail.php");
$send = new SenderEmails($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['coment']);
$send->send();
$send->get_result();
//print_r($_POST['name'],$_POST['phone'],$_POST['email'],$_POST['coment']);
?>
