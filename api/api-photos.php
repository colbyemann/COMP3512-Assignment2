<?php
require_once('../includes/config.inc.php');
require_once('../includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

//If parameters ISO, CityCode, Title, or Email are present pull results from database with WHERE, otherwise reterive all Countries
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
    $username = filter_var($_GET['Email'], FILTER_SANITIZE_EMAIL);
    $result = getUser($connection, $username);
    echo $result;
}
else {
   $result = getAllPhotos($connection);
   echo $result;
};

//sql Select statement for reteriving all nessecary data from cities table in the database
function getPhotosSQL() {
   $sql = "SELECT ImageID,UserID,Title,Description,Latitude,Longitude,CityCode,CountryCodeISO,ContinentCode,Path,Exif,ActualCreator,Colors FROM imagedetails";
   return $sql;
}

//fetch json of all photos from database
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

//fetch all photos WHERE CountryCodeISO = ISO to json from database
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

//fetch all photos WHERE CityCOde = code to json from database
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

//fetch all photos WHERE Title = title to json from database
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

//Special function to pull specific user info from users table db
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