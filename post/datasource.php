<?php
include('../services.php');

$label = $_GET["name"];
$active = $_GET["active"];
$station = $_GET["station"];

saveDatasource($db, $label,$active, $station);

?>