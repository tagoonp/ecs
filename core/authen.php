<?php
session_start();
include "../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM trs_useraccount WHERE (acc_username = '%s' OR acc_email = '%s') AND acc_password = '%s' AND acc_status = 'Yes' AND acc_activate = 'Yes'", mysql_real_escape_string($_POST['username']), mysql_real_escape_string($_POST['username']), mysql_real_escape_string(md5($_POST['password'])));
$result = $db->select($strSQL,false,true);

if($result){
  $_SESSION['ecsSessid'] = session_id();
  $_SESSION['ecsUsername'] = $result[0]['acc_id'];
  $_SESSION['ecsUtype'] = $result[0]['acc_type'];

  $strSQL = sprintf("INSERT INTO trs_access_log (ip_address, acc_date_time, acc_username, acc_page, acc_status) VALUES ('%s','%s','%s','%s','%s')", mysql_real_escape_string(getenv('REMOTE_ADDR')), mysql_real_escape_string(date('Y-m-d H:i:s')), mysql_real_escape_string($_SESSION['ecsUsername']), mysql_real_escape_string('authen.php'), mysql_real_escape_string('Yes'));
  $resultInsert = $db->insert($strSQL,false,true);

  // print $strSQL;
  session_write_close();
  print "Y";
  $db->disconnect();
}else{
  $strSQL = sprintf("INSERT INTO trs_access_log (ip_address, acc_date_time, acc_username, acc_page, acc_status) VALUES ('%s','%s','%s','%s','%s')", mysql_real_escape_string(getenv('REMOTE_ADDR')), mysql_real_escape_string(date('Y-m-d H:i:s')), mysql_real_escape_string($_SESSION['ecsUsername']), mysql_real_escape_string('authen.php'), mysql_real_escape_string('No'));
  $resultInsert = $db->insert($strSQL,false,true);

  // print $strSQL;
  print "N";
  $db->disconnect();
}
?>
