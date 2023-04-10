<?php
  session_start(); 
   session_destroy();
    unset($_SESSION['views']);
  header("Location: giveaway.php");
?>
