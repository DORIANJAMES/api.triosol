<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=utf8");
//header("Access-Control-Allow-Methods:POST,GET,PUT,DELETE");
//header("Access-Control-Allow-Headers:Origin,X-Requested-With,Content-Type,Accept,Authorization");
require_once '../API/boot.php';
$App = new App($config);
$db = new CrudPDO();
//print_r(json_encode($config['returnArray']));
?>