
<?php


function getInfo($iso){

$data = file_get_contents("http://localhost/Assignment_2/api-countries.php?ISO=" . $iso);
$country = json_decode($data, true);
echo "<section id='infoSec'>";
foreach($country as $c){
    echo "<h4>" . $c['CountryName'] . "</h4>";
    echo "<p>" . $c['Capital'] . "</p>";
    echo "<p>Area: " . $c['Area'] . "</p>";
    echo "<p>Population: " . $c['Population'] . "</p>";
    echo "<p>" . $c['CurrencyCode'] . "</p>";
    echo "<p>" . $c['TopLevelDomain'] . "</p>";
    echo "<p>" . $c['Languages'] . "</p>";
    echo "<p>" . $c['Neighbours'] . "</p>";
    echo "<p>" . $c['CountryDescription'] . "</p>";

}
                    
    echo "</section>";
}

?>