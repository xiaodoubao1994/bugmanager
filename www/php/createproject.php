<?php
  require_once('config.php');

  $act = $_GET["act"];
  $name = $_GET["name"];
  $description = $_GET["description"];

  if ($act == 'create') {
    $sql = "insert into project (name, description) values ('$name', '$description')";
    // echo $sql;
  } else if ($act == 'update') {
    $id = $_GET["id"];
    $sql = "update project set name = '$name', description = '$description' where id = $id";
  }


  $result = mysql_query($sql);

  $count = mysql_affected_rows();

  $project_id = mysql_insert_id();

  $members = $_GET["members"];

  $users = explode(',', $members);

  $sql_2 = "";


  if ($act == "create") {
    foreach ($users as $user) {
      $sql_2 = "insert into project_user (project_id, user_id) values ($project_id, $user);";
      $result_2 = mysql_query($sql_2);
      $count_2 = mysql_affected_rows($varcon);
    }
  }  else if ($act == 'update') {
      $sql_2 = "delete from project_user where project_id = $id ";
      $result_2 = mysql_query($sql_2);
      foreach ($users as $user) {
        $sql_2 = "insert into project_user (project_id, user_id) values ($id, $user);";
        // echo $sql_2;
        $result_2 = mysql_query($sql_2);
        $count_2 = mysql_affected_rows($varcon);
      }
  }








  // echo $sql_2;


  // echo $count_2;

  $json = array();

  if ($count_2 != 0) {
    $json["code"] = 1;
    $json["msg"] = "成功";
  } else {
    $json["code"] = 0;
    $json["msg"] = "失败";
  }
  echo json_encode($json);


?>
