<?php
function getCountriesByISO($iso){

    //change links
$data = file_get_contents("http://localhost/Assignment_2/api-countries.php?ISO=" . $iso);
return  json_decode($data, true);

};

function getCitiesByISO($iso){

    //change links
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?ISO=" . $iso);
    return  json_decode($data, true);

};
?>