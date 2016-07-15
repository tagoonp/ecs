<?php
session_start();
include "../database/database.class.php";
$db = new database();
$db->connect();

if((isset($_SESSION['ecsUsername'])) && ($_SESSION['ecsUsername']!='')){
  $strSQL = sprintf("INSERT INTO trs_access_log (ip_address, acc_date_time, acc_username, acc_page, acc_status) VALUES ('%s','%s','%s','%s','%s')", mysql_real_escape_string(getenv('REMOTE_ADDR')), mysql_real_escape_string(date('Y-m-d H:i:s')), mysql_real_escape_string($_SESSION['ecsUsername']), mysql_real_escape_string($_POST['pages']), mysql_real_escape_string('Yes'));
  $resultInsert = $db->insert($strSQL,false,true);
}else{
  $strSQL = sprintf("INSERT INTO trs_access_log (ip_address, acc_date_time, acc_page, acc_status) VALUES ('%s','%s','%s','%s')", mysql_real_escape_string(getenv('REMOTE_ADDR')), mysql_real_escape_string(date('Y-m-d H:i:s')), mysql_real_escape_string($_POST['pages']), mysql_real_escape_string('Yes'));
  $resultInsert = $db->insert($strSQL,false,true);
}


$db->disconnect();
?>
