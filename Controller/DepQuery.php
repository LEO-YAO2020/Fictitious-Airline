<?php
include_once "../Model/Sql.php";
$link = new Connection();

$depQuery = new depQuery($link);
$dep=$depQuery->getTable();
$json = json_encode($dep);
echo $json;
$link->SqlClose();