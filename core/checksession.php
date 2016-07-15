<?php
if(isset($_SESSION['ecsSessid'])){
  if($_SESSION['ecsSessid'] == session_id()){
    
  }else{
    header('Location: ../session-denine.php');
    exit();
  }
}else{
  header('Location: ../session-denine.php');
  exit();
}

?>
