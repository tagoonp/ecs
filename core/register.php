<?php
include "../database/database.class.php";
$db = new database();
$db->connect();

$strSQL = sprintf("SELECT * FROM trs_useraccount WHERE acc_email = '%s' OR acc_username = '%s'", mysql_real_escape_string($_POST['email']), mysql_real_escape_string($_POST['email']));
$result = $db->select($strSQL,false,true);

if(!$result){
  $strSQL = sprintf("INSERT INTO trs_useraccount (acc_fname, acc_lname, acc_prefixid, acc_instituteid, acc_phone, acc_email, acc_password, acc_regdate, acc_type, acc_status, acc_activate, acc_sid)
            VALUES
            ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            mysql_real_escape_string($_POST['fname']),
            mysql_real_escape_string($_POST['lname']),
            mysql_real_escape_string($_POST['prefix']),
            mysql_real_escape_string($_POST['dept']),
            mysql_real_escape_string($_POST['phone']),
            mysql_real_escape_string($_POST['email']),
            mysql_real_escape_string(md5('1234')),
            mysql_real_escape_string(date('Y-m-d')),
            mysql_real_escape_string('4'),
            mysql_real_escape_string('Yes'),
            mysql_real_escape_string('Yes'),
            mysql_real_escape_string(''));
  $resultInsert = $db->insert($strSQL,false,true);
  if($resultInsert){
    print "Y";
  }else{
    print "N";
  }
}else{
  print "Duplicate email address!";
  exit();
}

$db->disconnect();

?>
