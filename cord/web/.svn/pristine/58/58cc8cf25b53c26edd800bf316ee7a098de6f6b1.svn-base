<?php

session_start();

if($_SESSION['type']=='교수'){
}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}

require ('../lib/db.php');

$subject = $_POST['subject'];
$date = $_POST['date'];

$query=$PDO->prepare("select keycode from web.qr where subject = :subject and date = :date");
$query->bindParam(':subject',$subject);
$query->bindParam(':date',$date);
$query->execute();
$key=$query->fetch();

$key = $key['keycode'];

if(boolval($key)==false){
    $query=$PDO->prepare("select name,code,subjectcode from web.subjectcode where subject = :subject and code = :code");
    $query->bindParam(':subject', $subject);
    $query->bindParam(':code', $_SESSION['studentcode']);
    $query->execute();
    $user=$query->fetchAll();

    $now = new DateTime();
    $now->setTimezone(new DateTimeZone("Asia/Seoul"));
    $data = $now->format('Y-m-d H:i:s');
    $key = sha1(md5($data.$subject));

    $name = $user[0]['name'];
    $code = $user[0]['code'];
    $subjectcode = $user[0]['subjectcode'];

    $query=$PDO->prepare("update web.qr set keycode = :key where name = :name and code = :code and subjectcode = :subjectcode and date = :date");
    $query->bindParam(':name', $name);
    $query->bindParam(':code', $code);
    $query->bindParam(':subjectcode', $subjectcode);
    $query->bindParam(':date',$date);
    $query->bindParam(':key', $key);
    $query->execute();
    $PDO->query("commit");
}

echo $key;