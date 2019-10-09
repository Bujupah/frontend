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

    $query = "SELECT count(*) from _gateway";
    $result = $db->query($query);
    $res = $result->fetch(PDO::FETCH_ASSOC)['count'];

    if ($res == 1 )
        $query = "UPDATE public._gateway SET label='$label', longitude=$longitude, latitude=$latitude, address='$address', ip='$ip', port=$port, live_date='$live_date', protocol='$protocol';" ;
    else
        $query = "INSERT INTO public._gateway values($id, '$label' ,$longitude ,$latitude ,'$address' ,'$ip' ,$port ,'$live_date' ,'$protocol',null)";

    $db->query($query);
}

function saveStation($db, $label ,$gateway){
    $query = "SELECT id FROM _gateway WHERE label='$gateway';";
    $result = $db->query($query);
    $res = $result->fetch(PDO::FETCH_ASSOC)['id'];
    $query = "INSERT INTO public._station(label, _gateway_id) VALUES ('$label', $res);";
    $db->query($query);
}
function saveDatasource($db, $label ,$active, $station){
    $query = "SELECT id FROM _station WHERE label='$station';";
    $result = $db->query($query);
    $res = $result->fetch(PDO::FETCH_ASSOC)['id'];
    $query = "INSERT INTO public._datasource(label, isactive, _station_id) VALUES ('$label', $active, $res);";
    $db->query($query);
}

function saveSensor($db, $label, $name, $tags, $active, $datasource){
    $query = "SELECT id FROM _datasource WHERE label='$datasource';";
    $result = $db->query($query);
    $res = $result->fetch(PDO::FETCH_ASSOC)['id'];
    $query = "INSERT INTO public._sensor(label, name, tags, isactive, _datasource_id) VALUES ('$label', '$name', '$tags', $active, $res);";
    $db->query($query);
}

?>