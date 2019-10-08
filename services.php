<?php


// property declaration
$db = new PDO('pgsql:host=localhost;dbname=smart_local','postgres', 'root');
// method declaration
function test($db) {
    if($db){
        echo "All good";
    }
}
function init($db){
    $query = "SELECT count(*) FROM _user;";
    $result = $db->query($query);
    $data = $result->fetch();
    if($data[0] == 0){
        $query = "insert into _user values(0,'admin','".base64_encode("admin")."',null);";
        $result = $db->query($query);
        return  "Smart System detected, default system user has been created <br> Please change the password after you login <br>";
    }
    return "";
}
function detectUser($db){
    $password = base64_encode("admin");
    $query = "SELECT count(*) FROM _user where username='admin' and password='$password';";
    $result = $db->query($query);
    $data = $result->fetch();
    return $data[0];
}


function login($db,$user,$password){
    $query = "SELECT * FROM _user WHERE username='$user' AND password='$password';";
    $result = $db->query($query);
    $data = $result->fetch();
    if ($data['username']!=$user){
        return 0;
    }
    return base64_encode($data['username'].",".$data['password']);
}

function getSystemData($db,$from){
    $query = "SELECT * FROM _$from;";
    $result = $db->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function saveGateway($db,$id, $label ,$longitude ,$latitude ,$address ,$ip ,$port ,$live_date ,$protocol){
    $init = "DELETE FROM _gateway";
    $query = "INSERT INTO _gateway values($id, $label ,$longitude ,$latitude ,$address ,$ip ,$port ,$live_date ,$protocol)";
    $db->query($init);
    $db->query($query);
}

?>