<?php
include_once "../Model/Sql.php";
$link = new Connection();
$arrName = $_GET['depName'];

$arrQuery = new arrQuery($link,$arrName);
$arr=$arrQuery->getTable();
$json = json_encode($arr);
echo $json;
$link->SqlClose();