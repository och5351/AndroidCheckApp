<?php

session_start();

if($_SESSION['type']=='교수'){
}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}

require ('../lib/db.php');

$class_name = $_POST['class_name'];
$date = $_POST['date'];

$query=$PDO->prepare("select keycode from web.class_auth where class_name = :class_name and date = :date");
$query->bindParam(':class_name',$class_name);
$query->bindParam(':date',$date);
$query->execute();
$key=$query->fetch();

$key = $key['keycode'];

if(boolval($key)==false){
    $query=$PDO->prepare("select user_id, name, class_code from web.class where class_name = :class_name and user_id = :user_id");
    $query->bindParam(':class_name', $class_name);
    $query->bindParam(':user_id', $_SESSION['user_id']);
    $query->execute();
    $user=$query->fetchAll();

    $now = new DateTime();
    $now->setTimezone(new DateTimeZone("Asia/Seoul"));
    $data = $now->format('Y-m-d H:i:s');
    $key = sha1(md5($data.$class_name));

    $name = $user[0]['name'];
    $user_id = $user[0]['user_id'];
    $class_code = $user[0]['class_code'];

    $query=$PDO->prepare("update web.class_auth set keycode = :key where name = :name and user_id = :user_id and class_code = :class_code and date = :date");
    $query->bindParam(':name', $name);
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':class_code', $class_code);
    $query->bindParam(':date',$date);
    $query->bindParam(':key', $key);
    $query->execute();
    $PDO->query("commit");
}

echo $key;