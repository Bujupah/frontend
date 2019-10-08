<?php
require('../services.php');

$username = $_GET['username'];
$password = base64_encode($_GET['password']);

echo login($db,$username,$password);

?>