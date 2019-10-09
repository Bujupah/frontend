<?php
include('../services.php');

$id = 0;
$label = $_GET["name"];
$longitude = explode(",",$_GET["coordination"])[0];
$latitude = explode(",",$_GET["coordination"])[1];
$address = $_GET["address"];
$ip = $_GET["ip"];
$port = $_GET["port"];
$live_date = $_GET["live_date"];
$protocol = $_GET["protocol"];

echo saveGateway($db,$id, $label ,$longitude ,$latitude ,$address ,$ip ,$port ,$live_date ,$protocol);
?>