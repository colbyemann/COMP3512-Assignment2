<?php
require_once('../includes/config.inc.php');
require_once('../includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

//If parameters ISO are present pull results from database with WHERE, otherwise reterive all Countries
if(isset($_GET['ISO'])) {
   $received = preg_replace("/[^a-zA-Z]/", "", $_GET['ISO']);
   $result = getCountriesByISO($connection, $received);
   echo $result;
}
else {
   $result = getAllCountries($connection);
   echo $result;
};

//sql Select statement for reteriving all nessecary data from countries table in the database
function getCountriesSQL() {
   $sql = "SELECT ISO, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyName, Languages, Neighbours, CountryDescription FROM countries";
   return $sql;
}

//fetch json of all countries from database
function getAllCountries($connection) {
   $sql = getCountriesSQL();
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

//fetch all countries WHERE ISO = ISO to json from database
function getCountriesByISO($connection, $iso) {
   $sql = getCountriesSQL();
   $sql = $sql . " WHERE ISO='$iso'";
    
   $result = runQuery($connection, $sql, null);
   // Convert to JSON

   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
      
   }
   return json_encode($rows);
}
?>