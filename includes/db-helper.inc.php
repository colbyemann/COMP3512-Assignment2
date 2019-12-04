<?php
function getCountriesByISO($iso){

    //change links
$data = file_get_contents("http://localhost/Assignment_2/api-countries.php?ISO=" . $iso);
return  json_decode($data, true);

};

function getCitiesByISO($iso){
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?ISO=" . $iso);
    return  json_decode($data, true);

};

function getCitiesByCityCode($code)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?citycode=$code");
    return json_decode($data, true);
};

function getAllPhotos(){
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php");
    return json_decode($data, true);
};

function getPhotosByISO($iso){
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php?ISO=" . $iso);
    return json_decode($data, true);
};

function getPhotosByCityCode($code){
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php?citycode=" . $code);
    return json_decode($data, true);
};
?>