<?php
//echo phpinfo();

error_reporting(~0);
ini_set('display_errors', 1);

$url = "http://103.27.60.212:8888/api_tan.php";
$bool = file_get_contents($url);
var_dump($bool);

?>