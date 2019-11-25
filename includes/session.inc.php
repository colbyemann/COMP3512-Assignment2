<?php

include('config.inc.php');
session_start();
   
if(!isset($_SESSION['user_id'])) {
   header('Location: index.php');
   exit;
}
else {
   // Show users the page!
}

?>