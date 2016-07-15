<?php
include "../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM trs_institute WHERE inst_name = '%s'", mysql_real_escape_string($_POST['dept_name']));
$result = $db->select($strSQL,false,true);

if(!$result){
  $strSQL = sprintf("INSERT INTO trs_institute (inst_name) VALUES ('%s')", mysql_real_escape_string($_POST['dept_name']));
  $resultInsert = $db->insert($strSQL,false,true);
  print "Y";
}else{
  print "N";
}

$db->disconnect();

?>
