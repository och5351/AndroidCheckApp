<?php

session_start();

require ('lib/db.php');

$key = $_POST['key'];
$user_id = $_POST['user_id'];

if(empty($_POST)){
    header('HTTP/1.1 404');
    exit();
}

$query=$PDO->prepare("select * from web.class_auth where keycode = :key");
$query->bindParam(":key", $key);
$query->execute();
$result=$query->fetch();

if(boolval($result)==false){
    header('HTTP/1.1 404');
    exit();
}else{
    $class_code = $result['class_code'];
    $date = $result['date'];

    $query=$PDO->prepare("update web.class_attendance set yn = 1 where user_id = :code and class_code = :class_code and date = :date");
    $query->bindParam(":code",$user_id);
    $query->bindParam(":class_code",$class_code);
    $query->bindParam(":date",$date);
    $query->execute();
}