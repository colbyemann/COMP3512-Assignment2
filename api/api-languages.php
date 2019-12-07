<?php
require_once('../includes/config.inc.php');
require_once('../includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

if(isset($_GET['ISO'])) {
   $received = preg_replace("/[^a-zA-Z]/", "", $_GET['ISO']);
      $result = getLanguagesByISO($connection, $received);
      echo $result;
}
else {
   $result = getAllLanguages($connection);
   echo $result;
};

function getLanguagesSQL() {
   $sql = "SELECT name, iso FROM languages";
   return $sql;
}

function getAllLanguages($connection) {
   $sql = getLanguagesSQL();
   $rows = array();
   try {
      $result = runQuery($connection, $sql, null);
      
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         $rows[] = $row;
      }
      return json_encode($rows);
   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }   
}

function getLanguagesByISO($connection, $iso) {
   $sql = getLanguagesSQL();
   $sql = $sql . " WHERE iso='$iso'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}
?>