<?php

function getInfo($iso) {

    $country = getCountriesByISO($iso);

    echo "<section id='infoSec'>";

    foreach($country as $c){
        echo "<h4>" . $c['CountryName'] . "</h4>";
        parameterCheck($c['Capital'], "Capital: ");
        parameterCheck($c['Area'], "Area: ");
        parameterCheck($c['CurrencyName'], "Currency: ");
        parameterCheck($c['Population'], "Population: ");
        parameterCheck($c['TopLevelDomain'], "Domain: ");
        
        $lang = getLang($c['Languages']);
        if($lang != null)
        {
            echo "<p>Languages: ";
        foreach($lang as $l){
            echo $l['name'] . " ";
        };
        echo "</p>";
        };
        
        $neighbours = getNeighbours($c['Neighbours']);
        if($neighbours != null)
        {
            echo "<p>Neighbours: ";
        foreach($neighbours as $n){
            echo $n['CountryName'] . " ";
        };
        echo "</p>";
        };
        echo "<p>" . $c['CountryDescription'] . "</p>";

    }                  
        echo "</section>";
}

function getLang($code) {
    $extract =  explode("," , $code);
    $rows = array();

    foreach($extract as $e) {
        $cut = substr($e, 0, 2);
        $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
        $sql = "SELECT name FROM languages"  . " WHERE iso='$cut'";
        try {
            $result = runQuery($connection, $sql, null);
    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
            }
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
    return $rows;
}

function getNeighbours($code) {
    $extract =  explode("," , $code);
    $rows = array();

    foreach($extract as $e) {
        $cut = substr($e, 0, 2);
        $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
        $sql = "SELECT CountryName FROM countries"  . " WHERE iso='$cut'";
        try {
            $result = runQuery($connection, $sql, null);
    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
            }
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
    return $rows;
}

function parameterCheck($parameter, $title) {
    if(!empty($parameter))
    {
        echo "<p>" . $title . $parameter . "</p>";
    }
}

function getCities($iso) {
    $city = getCitiesByISO($iso);

    if(empty($city)) {
        echo "<p>No Cities Available</p>";
    }
    else {
        // Comparison function from https://www.php.net/manual/en/function.uasort.php
        function cmp($a, $b) {
        if ($a['AsciiName'] == $b['AsciiName']) {
            return 0;
        }
        return ($a['AsciiName'] < $b['AsciiName']) ? -1 : 1;
        }

        // Sort and print the resulting array
        uasort($city, 'cmp');

        foreach($city as $c) {
            echo "<a href='" . $GLOBALS['singleCityPage'] . "?citycode=". $c['CityCode']  ."'><li>" . $c['AsciiName'] ."</li></a>";
        }
    }
}

function getPhotos($iso) {
  
    $photos = getPhotosByISO($iso);

    if(empty($photos)) {
        echo "<p>No Photos Available</p>";
    }
    else {
        foreach($photos as $p)
        {
            echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $p['ImageID']  ."'><img src='images/square150/". $p['Path'] . "'></img></a>";
        }
    }
}

?>