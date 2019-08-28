<?php
/**
 * Created by PhpStorm.
 * User: och
 * Date: 2019-04-07
 * Time: 오전 2:40
 */

error_reporting(E_ALL);
ini_set('display_errors',1);

require('lib/db.php');
//$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
//if($android) {
    $query=$_POST['query'];
    $stmt = $PDO->query($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $data = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($data,
                $row);
        }

        header('Content-Type: application/json; charset=utf8');
        $json = json_encode(array(""=>$data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;
    }
//}
?>