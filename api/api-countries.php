<?php

function getCountriesSQL() {
    //change this to countires
    $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
    $sql .= " ORDER BY GalleryName";
    return $sql;
 }

 function getAllCountries($connection) {
    $sql = getCountriesSQL();
    try {
      $result = runQuery($connection, $sql, null);
      return $result;
   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }   
  }

  function getCountriesByISO($connection, $iso) {
    
    $sql = getCountriesSQL();
    $sql = $sql . ' WHERE iso=' . $iso;
    
   
    $result = runQuery($connection, $sql, null);
   
}




?>