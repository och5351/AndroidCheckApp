<?php

session_start();

require ('../lib/db.php');

if($_SESSION['type']=='학생') {
}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}

?>
<!DOCTYPE html>
<html lang="ko">
   <head>
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta charset="UTF-8">
       <title class="relative">GNTech QR Attendance</title>
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
       <link rel="stylesheet" href="/lib/materialize.min.css">
       <link rel="stylesheet" href="/lib/style.css">
       <script src="/lib/jquery-3.3.1.min.js"></script>
       <script src="/lib/materialize.min.js"></script>
       <script src="/lib/script.js"></script>
       <style>
           @import "../lib/StudentPageCSS.css";
       </style>
   </head>
   <body>
   <div class="all">
       <form id="Logout">
           <div class="row right-align">
               <p class="logoutbox"><?=$_SESSION['name']?> 님의 출석부입니다.</p>
               <button  class="btn waves-effect waves-light btn-small" type="submit" name="action">로그아웃
                   <i class="material-icons right">send</i>
               </button>
           </div>
       </form>
       <p class="title">
          출석 기록부
       </p>
       <hr>
       <br>
       <fieldset>
           <legend><p class="subject">과목별 출석부</p></legend>
               <?php
               echo '<div class="middle">';
               $user_id = $_SESSION["user_id"];
               foreach($PDO->query("SELECT class_name FROM web.class_enrol WHERE user_id = $user_id") as $row){
                   ?>
                   <button class="detail btn waves-effect waves-light position" type="submit" name="action" onClick="goPage('<?=$row[0]?>')">조회
                       <i class="material-icons right">send</i>
                   </button>
                   <p class=relative><?=$row[0]?></p>
                   <hr><br><br>
               <?}?>
       </fieldset>
   </div>
   </body>
</html>