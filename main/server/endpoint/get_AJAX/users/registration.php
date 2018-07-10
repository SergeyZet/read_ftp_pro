<?php
$json = json_decode($_POST['json']);
print_r($json);
print_r($json->status);
//print_r(json_decode($_POST['json']))
//$result = addUser($user);
//print_r($result);
/*{
 "id" : 		     (id  , -1	 , -1),
 "error_code" : (null, -1	 , 500),
 "reason" : 	   (null, "email", "server"),
}*/
?>