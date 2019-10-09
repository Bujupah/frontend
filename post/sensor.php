<?php
include('../services.php');

$label = $_GET['label'];
$name = $_GET['name'];
$tags = $_GET['tags'];
$active = $_GET['active'];
$datasource = $_GET['datasource'];

saveSensor($db, $label, $name, $tags, $active, $datasource);

?>