<?php
require('services.php');
$from = $_GET['from'];
echo json_encode(getSystemData($db,$from));
?>