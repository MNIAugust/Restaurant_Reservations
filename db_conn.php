<?php

define('DB_SERVER', 'localhost');
define('DB_NAME', 'coktai_1203as');
define('DB_USER', 'root');
define('DB_PASS', '');

$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);


if(empty($db->connect_error)){
  
}else{
    echo $db->connect_error;
    exit;
}