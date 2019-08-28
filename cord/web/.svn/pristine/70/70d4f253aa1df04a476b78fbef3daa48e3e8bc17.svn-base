<?php

session_start();

require ('lib/db.php');

$key = $_POST['key'];
$userid = $_POST['user_id'];
$machine = $_POST['machine'];
$phone = $_POST['phone'];

if(empty($_POST)){
    header('HTTP/1.1 404');
    exit();
}

$query=$PDO->prepare("select * from web.qr where keycode = :key");
$query->bindParam(":key", $key);
$query->execute();
$result=$query->fetch();

if(boolval($result)==false){
    header('HTTP/1.1 404');
    exit();
}else{
    $subjectCode = $result['subjectcode'];
    $date = $result['date'];

    $query=$PDO->prepare("update web.attendance set yn = 1 where code = :code and subjectcode = :subjectcode and date = :date");
    $query->bindParam(":code",$userid);
    $query->bindParam(":subjectcode",$subjectCode);
    $query->bindParam(":date",$date);
    $query->execute();
}