<?php
include('../services.php');

$id = 0;
$label = $_GET["label"];
$longitude = $_GET["longitude"];
$latitude = $_GET["latitude"];
$address = $_GET["address"];
$ip = $_GET["ip"];
$port = $_GET["port"];
$live_date = $_GET["live_date"];
$protocol = $_GET["protocol"];

echo "$id $label $longitude $latitude $address $ip $port $live_date $protocol";
echo "saveGateway();";
?>