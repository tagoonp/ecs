<?php
$strSQL = sprintf("SELECT * FROM trs_useraccount WHERE acc_id = '%s' AND acc_type = '3' AND acc_status = 'Yes' AND acc_activate = 'Yes'",
          mysql_real_escape_string($_SESSION['ecsUsername'])
          );
$resultInfo = $db->select($strSQL,false,true);

if(!$resultInfo){

}
?>
<li class="dropdown dropdown-profile">
    <a href="javascript:void(0)" data-toggle="dropdown">
        <span class="m-r-sm"><?php print $resultInfo[0]['acc_fname']." ".$resultInfo[0]['acc_lname']; ?> <span class="caret"></span></span>
        <img class="img-avatar img-avatar-48" src="../assets/img/avatars/avatar3.jpg" alt="User profile pic" />
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        <li>
            <a href="../userinfo.php">ข้อมูลส่วนตัว</a>
        </li>
        <li>
            <a href="../changepassword.php">เปลี่ยนรหัสผ่าน</a>
        </li>
        <li>
            <a href="../signout.php">ออกจากระบบ</a>
        </li>
    </ul>
</li>
