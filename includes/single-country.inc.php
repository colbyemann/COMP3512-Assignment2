
<?php
require_once('includes\config.inc.php');
require_once('includes\db-functions.inc.php');


function getInfo($iso){

    //change links
$data = file_get_contents("http://localhost/Assignment_2/api-countries.php?ISO=" . $iso);
$country = json_decode($data, true);


echo "<section id='infoSec'>";

foreach($country as $c){
    echo "<h4>" . $c['CountryName'] . "</h4>";
    parameterCheck($c['Capital'], "Capital: ");
    parameterCheck($c['Area'], "Area: ");
    parameterCheck($c['CurrencyCode'], "Currency: ");
    parameterCheck($c['Population'], "Population: ");
    parameterCheck($c['TopLevelDomain'], "Domain: ");
    echo "<p>Languages: </p>";
    $lang = getLang($c['Languages']);
    foreach($lang as $l){
    parameterCheck($l['name'], "");
    };

    parameterCheck($c['Neighbours'], "Neighbours: ");
    echo "<p>" . $c['CountryDescription'] . "</p>";

}                  
    echo "</section>";
}

function getLang($code)
{
    $extract =  explode("," , $code);
    $rows = array();

    foreach($extract as $e)
    {
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

function parameterCheck($parameter, $title){
    if(!empty($parameter))
    {
        echo "<p>" . $title . $parameter . "</p>";
    }
}

function getCities($iso)
{
    //change links
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?ISO=" . $iso);
    $city = json_decode($data, true);

    // Comparison function from https://www.php.net/manual/en/function.uasort.php
    function cmp($a, $b) {
    if ($a['AsciiName'] == $b['AsciiName']) {
        return 0;
    }
    return ($a['AsciiName'] < $b['AsciiName']) ? -1 : 1;
    }

    // Sort and print the resulting array
    uasort($city, 'cmp');

    foreach($city as $c){
        echo "<a href='http://localhost/Assignment_2/single-city.php?citycode=". $c['CityCode']  ."'><li>" . $c['AsciiName'] ."</li></a>";
    }

}

function getPhotos($iso)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php?ISO=" . $iso);
    $photos = json_decode($data, true);

    foreach($photos as $p)
    {
        echo "<a href='http://localhost/Assignment_2/single-photo.php?ImageID=". $p['ImageID']  ."'><img src='images/square150/". $p['Path'] . "'></img></a>";
    }

}

?>