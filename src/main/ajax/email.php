<?php
require_once ('../email/Email.php');
$json = json_decode($_POST['json']);
$email = new Email($json->name,$json->phone,$json->email,$json->coment);
//$email->send();
$email->send_database();
print_r($json);
