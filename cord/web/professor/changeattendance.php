<?php

session_start();

require ('../lib/db.php');

$user_id = $_POST['user_id'];
$class_code = $_POST['class_code'];
$date = $_POST['date'];
$division = $_POST['division'];

$query=$PDO->prepare("update web.class_attendance set yn = '1' where user_id = :user_id and class_code = :class_code and division = :division and date = :date");
$query->bindParam(":user_id",$user_id);
$query->bindParam(":class_code",$class_code);
$query->bindParam(":division",$division);
$query->bindParam(":date",$date);
$query->execute();
$PDO->query("commit");
?>