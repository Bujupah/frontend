<?php
include('../services.php');

$label = $_GET["name"];
$gateway = $_GET["gateway"];

saveStation($db, $label, $gateway);

?>