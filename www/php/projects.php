<?php
  require_once("config.php");

  session_start();

  $userid = $_SESSION["userid"];
  $username = $_SESSION["username"];
  $usertype = $_SESSION["usertype"];

  $sql = "select * from project ";

  if ($usertype and $usertype != 1) {
    //   echo "xixixi";
      $sql = "select  p.* from  project p , project_user pu where pu.user_id = $userid and pu.project_id = p.id";
  }
  // echo $sql;

  $result = mysql_query($sql);
  // echo $result;
  $list = array();
  // echo $result;
  while($item = mysql_fetch_row($result)) {
    $obj = array();
    $obj["id"] = $item[0]; // 项目id

    // echo "id".$obj["id"];
    // 根据项目id查出项目成员
    $sql_2 = "select u.* from userinfo u, project_user pu where pu.project_id = ".$obj['id']." and  pu.user_id = u.id";
    // echo $sql_2;

    $result_2 = mysql_query($sql_2);
    // echo "rels_2".$result_2;
    $list_2 = array();
    while ($user=mysql_fetch_row($result_2)) {
      $obj_2 = array();
      $obj_2["id"] = $user[0];
      $obj_2["username"] = $user[1];
      $obj_2["type"] = $user[3];
      $list_2[] = $obj_2;
    }

    $obj["name"] = $item[1];
    $obj["description"] = $item[2];
    $obj["members"] = $list_2;
    $list[] = $obj;
  }

  echo json_encode($list);

?>
