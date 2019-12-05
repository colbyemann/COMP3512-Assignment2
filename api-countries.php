<?php
require_once('includes/config.inc.php');
require_once('includes/db-functions.inc.php');

$connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);

if(isset($_GET['ISO'])) {
   $result = getCountriesByISO($connection, $_GET['ISO']);
   echo $result;
}
else {
   $result = getAllCountries($connection);
   echo $result;
};

function getCountriesSQL() {
   //change this to countires
   $sql = "SELECT ISO, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyName, Languages, Neighbours, CountryDescription FROM countries";
   return $sql;
}

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

function getCountriesByISO($connection, $iso) {
   $sql = getCountriesSQL();
   $sql = $sql . " WHERE ISO='$iso'";
    
   $result = runQuery($connection, $sql, null);
   // Covert to JSON

   $rows = array();
      
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $rows[] = $row;
      
   }
   return json_encode($rows);
}
?>