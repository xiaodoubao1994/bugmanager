<?php
  require_once("config.php");

  $id = $_GET["id"];

  // 删除项目
  $sql = "delete from project where id = $id ";
  $result =  mysql_query($sql);
  $count = mysql_affected_rows();

  // 删除相关项目
  $sql = "delete from project_user where project_id=$id";
  mysql_query($sql);

  // 删除相关bug
  $sql = "delete from bug where project_id = $id";
  mysql_query($sql);

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
