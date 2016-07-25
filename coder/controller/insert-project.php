<?php
session_start();
include "../../database/database.class.php";
include "../../core/checksession.php";

$db = new database();
$db->connect();

$cb1_1 = 0; if(isset($_POST['cb1-1'])){ $cb1_1 = $_POST['cb1-1']; }
$cb1_2 = 0; if(isset($_POST['cb1-2'])){ $cb1_2 = $_POST['cb1-2']; }
$cb1_3 = 0; if(isset($_POST['cb1-3'])){ $cb1_3 = $_POST['cb1-3']; }
$cb1_4 = 0; if(isset($_POST['cb1-4'])){ $cb1_4 = $_POST['cb1-4']; }
$cb1_5 = 0; if(isset($_POST['cb1-5'])){ $cb1_5 = $_POST['cb1-5']; }
$cb1_6 = 0; if(isset($_POST['cb1-6'])){ $cb1_6 = $_POST['cb1-6']; }
$cb1_7 = 0; if(isset($_POST['cb1-7'])){ $cb1_7 = $_POST['cb1-7']; }

$cb2_1 = 0; if(isset($_POST['cb2-1'])){ $cb2_1 = $_POST['cb2-1']; }
$cb2_2 = 0; if(isset($_POST['cb2-2'])){ $cb2_2 = $_POST['cb2-2']; }
$cb2_3 = 0; if(isset($_POST['cb2-3'])){ $cb2_3 = $_POST['cb2-3']; }
$cb2_4 = 0; if(isset($_POST['cb2-4'])){ $cb2_4 = $_POST['cb2-4']; }
$cb2_5 = 0; if(isset($_POST['cb2-5'])){ $cb2_5 = $_POST['cb2-5']; }

$cb3_1 = 0; if(isset($_POST['cb3-1'])){ $cb3_1 = $_POST['cb3-1']; }
$cb3_2 = 0; if(isset($_POST['cb3-2'])){ $cb3_2 = $_POST['cb3-2']; }
$cb3_3 = 0; if(isset($_POST['cb3-3'])){ $cb3_3 = $_POST['cb3-3']; }
$cb3_4 = 0; if(isset($_POST['cb3-4'])){ $cb3_4 = $_POST['cb3-4']; }
$cb3_5 = 0; if(isset($_POST['cb3-5'])){ $cb3_5 = $_POST['cb3-5']; }

$strSQL = sprintf("INSERT INTO trs_research VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
          mysql_real_escape_string(''),
          mysql_real_escape_string($_POST['txt-projecttitle']),
          mysql_real_escape_string($_POST['txt-fund']),
          mysql_real_escape_string($cb1_1),
          mysql_real_escape_string($cb1_2),
          mysql_real_escape_string($cb1_3),
          mysql_real_escape_string($cb1_4),
          mysql_real_escape_string($cb1_5),
          mysql_real_escape_string($cb1_6),
          mysql_real_escape_string($cb1_7),
          mysql_real_escape_string($_POST['txt-cb1-otr']),
          mysql_real_escape_string($cb2_1),
          mysql_real_escape_string($cb2_2),
          mysql_real_escape_string($cb2_3),
          mysql_real_escape_string($cb2_4),
          mysql_real_escape_string($cb2_5),
          mysql_real_escape_string($_POST['txt-cb2-otr']),
          mysql_real_escape_string($cb3_1),
          mysql_real_escape_string($cb3_2),
          mysql_real_escape_string($cb3_3),
          mysql_real_escape_string($cb3_4),
          mysql_real_escape_string($cb3_5),
          mysql_real_escape_string($_POST['txt-cb3-otr']),
          mysql_real_escape_string(date('Y-m-d')),
          mysql_real_escape_string($_POST['txt-pi-id'])
          );

// print $strSQL;
// exit();

$resultInsert = $db->insert($strSQL,false,true);
if($resultInsert){
  ?>
  <script type="text/javascript">
    alert('Add new project success!');
    window.location = '../research-list.php?pi_id=' + <?php print $_POST['txt-pi-id']; ?>;
  </script>
  <?php
}else{
  ?>
  <script type="text/javascript">
    alert('Can not add new project!');
    window.history.back();
  </script>
  <?php
}
?>
