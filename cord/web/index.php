<?php

session_start();

if(isset($_SESSION['type'])){
    if($_SESSION['type']=='학생')
        echo '<script>location.href = "/student"; </script>';
    else
        echo '<script>location.href = "/professor"; </script>';
}

?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <meta charset="UTF-8">
        <title>GNTech QR Main</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/lib/materialize.min.css">
        <link rel="stylesheet" href="/lib/style.css">
        <script src="/lib/jquery-3.3.1.min.js"></script>
        <script src="/lib/materialize.min.js"></script>
        <script src="/lib/script.js"></script>
        <style>
            @media all and (min-width: 350px) and (max-width: 500px) {
                .row {
                    width: 500px;
                }
                html {
                    overflow-x: hidden;
                }
            }
        </style>
    </head>
<body>
<form id="LoginForm">
    <div class="chip">
        <img src="lib/logo.jpg">경남과학기술대학교 출석체크 시스템
    </div>
    <div class="row">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" type="text" name="user_id" class="validate">
                <label for="icon_prefix">학번</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">visibility</i>
                <input id="icon_visibility" type="password" name="passwd" class="validate">
                <label for="icon_visibility">비밀번호</label>
            </div>
        </div>
    </div>
    <div class="row center-align">
        <button class="btn waves-effect waves-light" type="submit" name="action">로그인
            <i class="material-icons right">send</i>
        </button>
    </div>
</form>
</body>
</html>
