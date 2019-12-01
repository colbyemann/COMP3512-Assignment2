
<?php
require_once('includes\config.inc.php');
require_once('includes\db-functions.inc.php');


function getInfo($iso){

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
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?ISO=" . $iso);
    $city = json_decode($data, true);

    foreach($city as $c){
        echo "<a href='http://localhost/Assignment_2/single-city.php?citycode". $c['CityCode']  ."'><li>" . $c['AsciiName'] ."</li></a>";
    }

}

?>