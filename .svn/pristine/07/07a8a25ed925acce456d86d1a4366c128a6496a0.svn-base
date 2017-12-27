<?php
    require_once('config.php');

    $id = $_GET["id"];
    $sql = "select * from userinfo where id=$id";

    $result = mysql_query($sql);

    $list = mysql_fetch_row($result);

    $json = array();

    $json["id"] = $list[0];
    $json["username"] = $list[1];
    $json["userpwd"] = $list[2];
    $json["usertype"] = $list[3];

    echo json_encode($json);

?>
