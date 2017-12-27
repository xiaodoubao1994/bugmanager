<?php
    require_once('config.php');

    $act = $_GET["act"];
    $username = $_GET["username"];
    $userpwd = $_GET["userpwd"];
    $usertype = $_GET["usertype"];

    if ($act == 'create') {
        $sql = "insert into userinfo (username, userpwd, type) values ('$username', '$userpwd', $usertype)";
    } else {
        $id = $_GET["id"];
        $sql = "update userinfo set username = '$username', userpwd = '$userpwd', type = $usertype where id = $id";
        // echo $sql;
    }

    $result = mysql_query($sql);

    $count = mysql_affected_rows();

    $json = array();

    if ($count > 0) {
        $json["code"] =1;
        $json["msg"] = "成功";
    } else {
        $json["code"] = 0;
        $json["msg"] = "失败";
    }

    echo json_encode($json);

?>
