<?php
require_once('includes\config.inc.php');
require_once('includes\db-functions.inc.php');

$photoArray = null;

function getArray(){
$data = file_get_contents("http://localhost/Assignment_2/api-photos.php");
$photos = json_decode($data, true);

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

function getLocation($iso, $code)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?citycode=$code");
    $cities = json_decode($data, true);

    $data2 = file_get_contents("http://localhost/Assignment_2/api-countries.php?ISO=" . $iso);
    $country = json_decode($data2, true);

    foreach($country as $c){
        if($c['ISO'] == $iso)
        {
        echo "<p>".  $c['CountryName'] . ", ";
        }
    };

    foreach($cities as $c){
        if($c['CityCode'] == $code)
        {
        echo $c['AsciiName'] . "</p>";
        }
    };

    
    

};

?>