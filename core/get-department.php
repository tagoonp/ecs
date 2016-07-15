<?php
include "../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM trs_institute");
$result = $db->select($strSQL,false,true);

$return = '';
if($result){
  for ($i=0; $i < sizeof($result); $i++) {
    $return[$i]['dept_id'] = $result[$i]['inst_id'];
    $return[$i]['dept_name'] = $result[$i]['inst_name'];
  }
}

echo json_encode($return);
$db->disconnect();

?>
