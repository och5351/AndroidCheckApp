<?php
session_start();
require ('../lib/db.php');

/*$subjectName = $_GET["subject"];
$studentCode = $_SESSION["studentcode"];
$subjectCodeResult = $PDO->query("select subjectcode from web.subjectcode where subject = '$subjectName'");
foreach ($subjectCodeResult as $row) {
    $subjectCode = $row['subjectcode'];
}*/

$ynResult = $PDO->query("select yn from attendance where code='{$_SESSION["studentcode"]}' AND subjectcode='{$_SESSION["subjectcode"]}' AND date='{$_SESSION["date"]}'");
foreach ($ynResult as $row) {
    $ynState = $row['yn'];
}

if($ynState == 1)
    $changeStateValue = 0;
else
    $changeStateValue = 1;

$query = $PDO->query("Update attendance SET yn='$changeStateValue' where code='{$_SESSION["studentcode"]}' AND subjectcode='{$_SESSION["subjectcode"]}' AND date='{$_SESSION["date"]}'");
$query->execute();
?>