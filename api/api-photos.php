<?php
require_once('../includes/config.inc.php');
require_once('../includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

if(isset($_GET['ISO'])) {
      $received = preg_replace("/[^a-zA-Z]/", "", $_GET['ISO']);
      $result = getPhotosByISO($connection, $received);
      echo $result;
}
else if(isset($_GET['CityCode']))
{
   $received = filter_var($_GET['CityCode'], FILTER_SANITIZE_NUMBER_INT);
   $result = getPhotosByCode($connection, $received);
      echo $result;
}
else if (isset($_GET['Title']))
{
    $result = getPhotosByTitle($connection, $_GET['Title']);
    echo $result;
}
else if (isset($_GET['Email']))
{
    $result = getUser($connection, $_GET['Email']);
    echo $result;
}
else {
   $result = getAllPhotos($connection);
   echo $result;
};

function getPhotosSQL() {
   $sql = "SELECT ImageID,UserID,Title,Description,Latitude,Longitude,CityCode,CountryCodeISO,ContinentCode,Path,Exif,ActualCreator,Colors FROM imagedetails";
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

function getPhotosByCode($connection, $code) {
   $sql = getPhotosSQL();
   $sql = $sql . " WHERE CityCode='$code'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}

function getPhotosByTitle($connection, $title) {
   $sql = getPhotosSQL();
   $sql = $sql . " WHERE Title='$title'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}

function getUser($connection, $userID)
{
   $sql = "SELECT FirstName,LastName,City,Country,Email  FROM users";
   $sql = $sql . " WHERE Email='$userID'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}
?>