<?php
@session_start();
session_destroy();
$url = "index.php";
  echo"<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=".str_replace('&amp;', '&', $url)."  \">";
exit();
?>
