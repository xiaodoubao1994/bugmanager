<?php
  require_once("config.php");

  // $type = $_GET["type"];

  $sql = "select * from userinfo";

  // if($type) {
  //     $sql .= " where type = '$type'";
  // }

  $result = mysql_query($sql);
  // echo $result;

  $list = array();

  while($item = mysql_fetch_row($result)) {
    $obj = array();
    $obj["id"] = $item[0];
    $obj["username"] = $item[1];
    $obj["userpwd"] = $item[2];
    $obj["type"] = $item[3];
    $list[] = $obj;
  }

  echo json_encode($list);

?>
