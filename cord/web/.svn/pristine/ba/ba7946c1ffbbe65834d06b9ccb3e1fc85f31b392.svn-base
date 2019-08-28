<?php
/**
 * Created by PhpStorm.
 * User: JinTae
 * Date: 2019-04-09
 * Time: 오전 11:22
 */

require ('lib/db.php');

$user_code = $_POST['user_id'];
$passwd = $_POST['passwd'];

if(empty($_POST)){
    header('HTTP/1.1 404');
    exit();
}

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

$login = array();
$login["userid"] = $user[0]['user_id'];
$login["name"] = $user[0]['name'];
$login["phone"] = $user[0]['phone'];
$login["type"] = $user[0]['type'];

header('Content-Type: application/json; charset=utf8');
$json = json_encode(array($login), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
echo $json;

?>