<?php
  require_once("config.php");
  session_start();

  $userid = $_SESSION["userid"];
  $username = $_SESSION["username"];
  $usertype = $_SESSION["usertype"];




  $sql = "select b.*, t.username as tester, a.username as assign, p.name as proname from bug b, userinfo t,userinfo a, project p where b.tester_id = t.id and a.id = b.assign_id and p.id = b.project_id ";


  if ($usertype == 2) {
    $sql .= "and b.assign_id = $userid";
  } else if ($usertype == 3) {
    $sql .= "and b.tester_id = $userid";
  }

  // if ($_GET["id"]) {
  //   $id = $_GET["id"];
  //   $sql .= " and b.id = $id";
  //   // echo $sql;
  // }


  $result = mysql_query($sql);
  // echo $result;

  $list = array();

  while($item = mysql_fetch_row($result)) {
    $obj = array();
    $obj["id"] = $item[0];
    $obj["title"] = $item[1];
    $obj["description"] = $item[2];
    $obj["project_id"] = $item[3];
    $obj["tester_id"] = $item[4];
    $obj["assign_id"] = $item[5];
    $obj["status"] = $item[6];
    $obj["level"] = $item[7];
    $obj["tester"] = $item[8];
    $obj["assign"] = $item[9];
    $obj["proname"] = $item[10];
    $list[] = $obj;
  }

  echo json_encode($list);

?>
