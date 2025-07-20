<?php session_start();

 unset($_SESSION["session1"]);
 session_destroy();
 header("location:index.php");
?>