<?php
    require_once('config.php');

    $id = $_GET["id"];
    $status = $_GET["status"];

    $sql = "update bug set status = $status where id = $id";

    $result = mysql_query($sql);
    $count = mysql_affected_rows();

    $json = array();

    if ($count > 0) {
        $json["code"] = 1;
        $json["msg"] = "成功";
    } else {
        $json["code"] = 0;
        $json["msg"] = "失败";
    }

    echo json_encode($json);

?>
