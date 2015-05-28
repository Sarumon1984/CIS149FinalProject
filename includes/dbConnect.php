<?php
$message = '';

$db = new mysqli('mysql.230development.devindelp.com' , 'devdel7','hlaotvee3','devindelp_cis230');
	if ($db->connect_error){
        $message = $db->connect_error;
    }else{
        $message = 'Database Connected!';
    }
?>