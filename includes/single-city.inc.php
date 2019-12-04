<?php

require_once('includes\config.inc.php');
require_once('includes\db-functions.inc.php');

$lat = "";
$long = "";
$name = "";

function getInfo($code){

    //change links
$data = file_get_contents("http://localhost/Assignment_2/api-cities.php?citycode=$code");
$cities = json_decode($data, true);

foreach($cities as $c){
    echo "<h4>" . $c['AsciiName'] . "</h4>";
    parameterCheck($c['Population'], "Population: ");
    parameterCheck($c['Elevation'], "Elevation: ");
    parameterCheck($c['TimeZone'], "TimeZone: ");
    $GLOBALS['lat'] = $c['Latitude'];
    $GLOBALS['long'] = $c['Longitude'];
    
}

};

function buildMap()
{
    
  echo "<img width=100% height=300px src='https://maps.googleapis.com/maps/api/staticmap?center=" . $GLOBALS['lat']. "," . $GLOBALS['long']. "&zoom=12&scale=1&size=500x300&maptype=roadmap&format=png&visual_refresh=true&key=AIzaSyDqyTT1dHib7v_0yGM8qaejN_ighZQ-UiY'>";
};

function parameterCheck($parameter, $title){
    if(!empty($parameter))
    {
        echo "<p>" . $title . $parameter . "</p>";
    }
};

function getPhotos($iso)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php?citycode=" . $iso);
    $photos = json_decode($data, true);

    if(empty($photos))
    {
        echo "<p>No Photos Available</p>";
    }
    else{
    foreach($photos as $p)
    {
        echo "<a href='http://localhost/Assignment_2/single-photo.php?ImageID=". $p['ImageID']  ."'><img src='images/square150/". $p['Path'] . "'></img></a>";
    }
}
}


?>