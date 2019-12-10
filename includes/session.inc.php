<?php

// Tests the session state. If logged in navigation is allowed, if not, user is redirected to the index page
session_start();
if(!isset($_SESSION['logged_in'])) {
   header('Location: index.php');
   exit;
}
else {
   // Let the navigation continue
}

?>