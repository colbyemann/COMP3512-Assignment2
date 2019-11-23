<?php
require_once('includes/configlive.inc.php');
require_once('includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

if(isset($_GET['ISO']))
    {
      $result = getCitiesByISO($connection, $_GET['ISO']);
      echo $result;
    }
else{
   $result = getAllCities($connection);
   echo $result;
   };

function getCitiesSQL() {
    $sql = "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM cities";
    return $sql;
 }

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
?>