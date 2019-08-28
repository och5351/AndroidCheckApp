<?php

session_start();

require ('lib/db.php');

if($_POST['param']=='logout'){
    session_destroy();
    exit();
}

if(empty($_POST['user_id']) || empty($_POST['passwd'])){
    header('HTTP/1.1 404');
    exit();
}else{
    $user_code = $_POST['user_id'];
    $passwd = $_POST['passwd'];

    $passwd = $passwd.'gntech';

    $passwd = sha1($passwd);

    $PDO->query('set names UTF8');
    $query=$PDO->prepare("select * from web.login where user_id = :user_id and password = :passwd");
    $query->bindParam(':user_id', $user_code);
    $query->bindParam(':passwd', $passwd);
    $query->execute();
    $user=$query->fetchAll();

    if(boolval($user)==false){
        header('HTTP/1.1 404 Not Data');
        exit();
    }

    $_SESSION['studentcode'] = $user[0]['user_id'];
    $_SESSION['name'] = $user[0]['name'];
    $_SESSION['type'] = $user[0]['type'];

    echo $_SESSION['type'];
}