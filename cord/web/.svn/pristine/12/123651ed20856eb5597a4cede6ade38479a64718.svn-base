<?php

session_start();

require ('../lib/db.php');

if($_SESSION['type']=='교수') {
}else{
    echo '<script>alert("올바른 접근이 아닙니다.");history.go(-1);</script>';
}
?>

<!doctype html>
<html lang="ko">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>GNTech QR Professor Attendance</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/lib/materialize.min.css">
    <link rel="stylesheet" href="/lib/style.css">
    <script src="/lib/jquery-3.3.1.min.js"></script>
    <script src="/lib/materialize.min.js"></script>
    <script src="/lib/script.js"></script>
    <link rel="stylesheet" href="../lib/attendance.css">
</head>

<body>
<div class="wrap">
    <header>
        <div class="buttons">
            <form id="Logout">
                <div class="row right-align">
                    <button  class="btn waves-effect waves-light btn-small" type="submit" name="action">로그아웃
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
            <button  class="btn waves-effect waves-light btn-small" type="submit" name="action" onclick="history.go(-1);">목록으로
                <i class="material-icons right">send</i>
            </button>
        </div>
    </header>
    <div id="content">
        <div class="title">
            <?php
            echo "<p>{$_GET['subject']} 출석 현황</p>";
            ?>
        </div>
        <table>
            <tr>
                <th>날짜</th>
                <th>학번</th>
                <th>학생명</th>
                <th>출석 여부</th>
                <th>출석 변경</th>
            </tr>
            <?php
            $subjectName = $_GET["subject"];
            $_SESSION['date'] = $_GET['date'];
            $date = $_SESSION['date'];
            $subjectCodeResult = $PDO->query("select subjectcode from web.subjectcode where subject = '$subjectName'");
            foreach ($subjectCodeResult as $row) {
                $_SESSION['subjectcode'] = $row['subjectcode'];
            }

            $subjectCode = $_SESSION['subjectcode'];
            $result = $PDO->query("select * from attendance where subjectcode='$subjectCode' AND date='$date'");
            foreach ($result as $rows) {
                echo '<tr>';
                echo '<td>' . $date . '</td>';
                echo '<td>'.$rows['code'].'</td>';
                echo '<td>'.$rows['name'].'</td>';
                if ($rows['yn'] == 1) {
                    echo '<td>O</td>';
                } else {
                    echo '<td>X</td>';
                }
                echo '<td> <form id="ChangeAttendance">
                                <input type="hidden" name="date" value="'.$date.'">
                                <input type="hidden" name="code" value="'.$rows['code'].'">
                                <input type="hidden" name="subjectCode" value="'.$subjectCode.'">
                                <input type="submit" value="변경">
                                </form></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</div>
</body>

</html>