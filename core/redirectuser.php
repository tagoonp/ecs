<?php
session_start();
include "checksession.php";
switch($_SESSION['ecsUtype']){
  case 1: header('Location: ../superadmin/');break;
  case 2: header('Location: ../admin/');break;
  case 3: header('Location: ../coder/');break;
  case 4: header('Location: ../general/');break;
  default: header('Location: ../session-denine.php');
}
?>
