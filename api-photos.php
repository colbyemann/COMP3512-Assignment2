<?php
require_once('includes/config.inc.php');
require_once('includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

if(isset($_GET['ISO'])) {
      $result = getPhotosByISO($connection, $_GET['ISO']);
      echo $result;
}
else {
   $result = getAllPhotos($connection);
   echo $result;
};

function getPhotosSQL() {
   $sql = "SELECT ImageID,UserID,Title,Description,Latitude,Longitude,CityCode,CountryCodeISO,ContinentCode,Path,Exif FROM imagedetails";
   return $sql;
}

function getAllPhotos($connection) {
   $sql = getPhotosSQL();
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

function getPhotosByISO($connection, $iso) {
   $sql = getPhotosSQL();
   $sql = $sql . " WHERE CountryCodeISO='$iso'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}
?>