<?php

session_start();

if($_SESSION['type']=='교수'){
}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}

require ('../lib/db.php');

$class_name = $_POST['class_name'];
$division = $_POST['division'];

$query=$PDO->prepare("select * from web.class where class_name = :class_name and division = :division and name = :name");
$query->bindParam(':class_name', $class_name);
$query->bindParam(':division', $division);
$query->bindParam(':name', $_SESSION['name']);
$query->execute();
$user=$query->fetch();

$class_code = $user['class_code'];
$class_division = $user['division'];

$query=$PDO->prepare("select * from web.class_attendance_day where class_code = :class_code and division = :division order by date");
$query->bindParam(':class_code', $class_code);
$query->bindParam(':division', $division);
$query->execute();
$attendance=$query->fetchAll();

$now = new DateTime();
$now->setTimezone(new DateTimeZone("Asia/Seoul"));
$date =$now->format('Y-m-d');

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>GNTech QR Professor</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../lib/materialize.min.css">
    <link rel="stylesheet" href="../lib/style.css">
    <link rel="stylesheet" href="../lib/professor.css">
    <script src="../lib/jquery-3.3.1.min.js"></script>
    <script src="../lib/materialize.min.js"></script>
    <script src="../lib/script.js"></script>
</head>
<body>
<table class="type07 centered">
    <thead>
    <tr>
        <th colspan="3" scope="cols" name="title"><?=$class_name?></th>
        <th style="display: none" name="division"><?=$division?></th>
    </tr>
    <tr>
        <th scope="cols">출석날짜</th>
        <th scope="cols">QR코드생성</th>
        <th scope="cols">결석자조회</th>
    </tr>
    </thead>
    <tbody>
    <?for($i=0; $i<count($attendance); $i++){?>
    <tr>
        <th scope="row"><p class="date"><?=$attendance[$i]['date']?></p></th>
        <?php
        if($attendance[$i]['date']==$date){?>
        <td>
            <button class="qr-btn btn waves-effect waves-light" type="submit" name="qrGenerator">QR코드생성
                <i class="material-icons right">build</i>
            </button>
        </td>
        <td>
            <button class="attendance btn waves-effect waves-light" type="submit" name="attendance">결석자조회
                <i class="material-icons right">assignment_ind</i>
            </button>
        </td>
        <?}else{?>
        <td>
            <div style="display: none">
                <button class="qr-btn btn waves-effect waves-light" type="submit" name="qrGenerator">QR코드생성
                    <i class="material-icons right">build</i>
                </button>
            </div>
        </td>
        <td>
            <div style="display: none">
                <button class="attendance btn waves-effect waves-light" type="submit" name="attendance">출석부조회
                    <i class="material-icons right">assignment_ind</i>
                </button>
            </div>
        </td>
        <?}?>
    </tr>
    <?}?>
    </tbody>
</table>
<div class="center-align back">
    <button class="btn waves-effect waves-light" type="submit" name="back">뒤로가기
        <i class="material-icons right">send</i>
    </button>
</div>
</body>
</html>
