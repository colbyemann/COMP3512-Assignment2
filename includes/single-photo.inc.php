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
}

?>