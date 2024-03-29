<?php

//Global Variables for Map location
$lat = "";
$long = "";
$name = "";

//get all info from Cities Code API JSON and post to INFO box
function getInfo($code) {
    $cities = getCitiesByCityCode($code);
    foreach($cities as $c) {
        echo "<h4>" . $c['AsciiName'] . "</h4>";
        parameterCheck($c['Population'], "Population: ");
        parameterCheck($c['Elevation'], "Elevation: ");
        parameterCheck($c['TimeZone'], "TimeZone: ");
        $GLOBALS['lat'] = $c['Latitude'];
        $GLOBALS['long'] = $c['Longitude'];
    }
}

function buildMap() {
    echo "<img width=100% height=300px src='https://maps.googleapis.com/maps/api/staticmap?center=" . $GLOBALS['lat']. "," . $GLOBALS['long']. "&zoom=12&scale=1&size=500x300&maptype=roadmap&format=png&visual_refresh=true&key=AIzaSyDqyTT1dHib7v_0yGM8qaejN_ighZQ-UiY'>";
}

//if parameter for info empty, skip posting that line ex: if no Population, skip over posting empty line
function parameterCheck($parameter, $title) {
    if(!empty($parameter)) {
        echo "<p>" . $title . $parameter . "</p>";
    }
}

//Get Photos only for cities that have photos, otherwise post no photos message
function getPhotos($code) {
    $photos = getPhotosByCityCode($code);

    if(empty($photos)) {
        echo "<p>No Photos Available</p>";
    }
    else {
        foreach($photos as $p) {
            echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $p['ImageID']  ."'><img src='images/square150/". $p['Path'] . "'></a>";
        }
    }
}

?>