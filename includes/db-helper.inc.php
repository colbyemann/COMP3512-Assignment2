<?php

function getAllCountries() {
    $data = file_get_contents("http://localhost/Assignment_2/api/api-countries.php");
    $countries = json_decode($data, true);
    return $countries;
}

function getCountriesByISO($iso) {
$data = file_get_contents("http://localhost/Assignment_2/api/api-countries.php?ISO=" . $iso);
return  json_decode($data, true);
}

function getCitiesByISO($iso) {
    $data = file_get_contents("http://localhost/Assignment_2/api/api-cities.php?ISO=" . $iso);
    return  json_decode($data, true);
}

function getCitiesByCityCode($code) {
    $data = file_get_contents("http://localhost/Assignment_2/api/api-cities.php?CityCode=" . $code);
    return json_decode($data, true);
}

function getAllPhotos() {
    $data = file_get_contents("http://localhost/Assignment_2/api/api-photos.php");
    return json_decode($data, true);
}

function getPhotosByISO($iso) {
    $data = file_get_contents("http://localhost/Assignment_2/api/api-photos.php?ISO=" . $iso);
    return json_decode($data, true);
}

function getPhotosByCityCode($code) {
    $data = file_get_contents("http://localhost/Assignment_2/api/api-photos.php?CityCode=" . $code);
    return json_decode($data, true);
}

function getPhotosByTitle($title) {
    $url = "http://localhost/Assignment_2/api/api-photos.php?Title=" . $title;
    $url = preg_replace("/ /", "%20", $url);
    $data = file_get_contents($url);
    return json_decode($data, true);
}

function regExpSearch($pattern, $list) {
    $matches = preg_match_all($pattern, $list);
    return $matches;
}

?>