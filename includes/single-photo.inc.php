<?php
require_once('includes\config.inc.php');
require_once('includes\db-functions.inc.php');
require_once('includes\db-helper.inc.php');

$photoArray = null;

function getArray(){

$photos = getAllPhotos();

$GLOBALS['photoArray'] = $photos;

};

function getImage($code)
{
    foreach($GLOBALS['photoArray'] as $p)
    {
        if($p['ImageID'] == $code)
        {
            echo "<img src='images/medium800/". $p['Path'] . "'></img>";
        };
    };
};

function getInfo($code)
{
    foreach($GLOBALS['photoArray'] as $p)
    {
        if($p['ImageID'] == $code)
        {
            echo "<h2 id=picTitle>" . $p['Title'] . "</h2>";
            echo "<p id=p1>" . $p['ActualCreator'] . "</p>" ;
            echo "<p id=p2>" . $p['Title'] . "</p>";
            getLocation($p['CountryCodeISO'], $p['CityCode']);
        };
    };
};

function getDesc($code)
{
    foreach($GLOBALS['photoArray'] as $p)
    {
        if($p['ImageID'] == $code)
        {
            echo "<p>" . $p['Description'] . "</p>";
            
        };
    };
};

function getExif($code)
{
    foreach($GLOBALS['photoArray'] as $p)
    {
        if($p['ImageID'] == $code)
        {
            $exif = json_decode($p['Exif'], true);
            
            echo "Aperture: " .  $exif['aperture'] . "<br>";
            echo "Exposure Time: " .  $exif['exposure_time'] . "<br>";
            echo "Focal Length: " .  $exif['focal_length'] . "<br>";
            echo "ISO: " .  $exif['iso'] . "<br>";
            echo "Make: " .  $exif['make'] . "<br>";
            echo "Model: " .  $exif['model'] . "<br>";
        };
    };
};
function getLocation($iso, $code)
{
    $cities = getCitiesByCityCode($code);
    $country = getCountriesByISO($iso);

    foreach($country as $c){
        if($c['ISO'] == $iso)
        {
        echo "<a href='http://localhost/Assignment_2/single-country.php?ISO=" . $c['ISO']. "'><p>".  $c['CountryName'] . ", </a> " ;
        }
    };

    foreach($cities as $c){
        if($c['CityCode'] == $code)
        {
        echo "<a href='http://localhost/Assignment_2/single-city.php?citycode=". $c['CityCode']. "'>". $c['AsciiName'] . "</p></a>";
        }
    };

 

    
    

};

?>