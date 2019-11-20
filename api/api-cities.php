<?php

function getCitiesSQL() {
    //change this to cities
    $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
    $sql .= " ORDER BY GalleryName";
    return $sql;
 }

 function getAllCities($connection) {
    $sql = getCitiesSQL();
    try {
      $result = runQuery($connection, $sql, null);
      return $result;
   }
   catch (PDOException $e) {
      die( $e->getMessage() );
   }   
  }

  function getCitiesByISO($connection, $iso) {
    
    $sql = getCItiesSQL();
    $sql = $sql . ' WHERE iso=' . $iso;
    
   
    $result = runQuery($connection, $sql, null);
   
}