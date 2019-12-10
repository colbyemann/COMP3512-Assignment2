<?php
require_once('../includes/config.inc.php');
require_once('../includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

//If parameters ISO or CityCode are present pull results from database with WHERE, otherwise reterive all cities
if(isset($_GET['ISO'])) {
      $received = preg_replace("/[^a-zA-Z]/", "", $_GET['ISO']);
      $result = getCitiesByISO($connection, $received);
      echo $result;
}
else if(isset($_GET['CityCode']))
{
   $received = filter_var($_GET['CityCode'], FILTER_SANITIZE_NUMBER_INT);
   $result = getCitiesByCode($connection, $received);
      echo $result;
}
else {
   $result = getAllCities($connection);
   echo $result;
};

//sql Select statement for reteriving all nessecary data from cities table in the database
function getCitiesSQL() {
   $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities";
   return $sql;
}

//fetch json of all cities from database
function getAllCities($connection) {
   $sql = getCitiesSQL();
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

//fetch all cities WHERE CountryCodeISO = ISO to json from database
function getCitiesByISO($connection, $iso) {
   $sql = getCitiesSQL();
   $sql = $sql . " WHERE CountryCodeISO='$iso'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}

//fetch all cities WHERE CityCode = ISO to json from database
function getCitiesByCode($connection, $iso) {
   $sql = getCitiesSQL();
   $sql = $sql . " WHERE CityCode='$iso'";
    
   $result = runQuery($connection, $sql, null);
   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
   }
   return json_encode($rows);
}
?>