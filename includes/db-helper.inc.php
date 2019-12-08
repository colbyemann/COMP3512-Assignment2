<?php

//global links APIs
$GLOBALS['apiCountries'] = "http://localhost/Assignment_2/api/api-countries.php";
$GLOBALS['apiCities'] = "http://localhost/Assignment_2/api/api-cities.php";
$GLOBALS['apiPhotos'] = "http://localhost/Assignment_2/api/api-photos.php";
//global links to "Single" Pages
$GLOBALS['singleCountryPage'] = "http://localhost/Assignment_2/single-country.php";
$GLOBALS['singlePhotoPage'] = "http://localhost/Assignment_2/single-photo.php";
$GLOBALS['singleCityPage'] = "http://localhost/Assignment_2/single-city.php";

function getAllCountries() {
    $data = file_get_contents($GLOBALS['apiCountries']);
    $countries = json_decode($data, true);
    return $countries;
}

function getCountriesByISO($iso) {
    $data = file_get_contents($GLOBALS['apiCountries'] . "?ISO=" . $iso);
    return  json_decode($data, true);
}

function getCitiesByISO($iso) {
    $data = file_get_contents($GLOBALS['apiCities'] . "?ISO=" . $iso);
    return  json_decode($data, true);
}

function getCitiesByCityCode($code) {
    $data = file_get_contents($GLOBALS['apiCities'] . "?CityCode=" . $code);
    return json_decode($data, true);
}

function getAllPhotos() {
    $data = file_get_contents($GLOBALS['apiPhotos']);
    return json_decode($data, true);
}

function getPhotosByISO($iso) {
    $data = file_get_contents($GLOBALS['apiPhotos'] . "?ISO=" . $iso);
    return json_decode($data, true);
}

function getPhotosByCityCode($code) {
    $data = file_get_contents($GLOBALS['apiPhotos'] . "?CityCode=" . $code);
    return json_decode($data, true);
}

function getPhotosByTitle($title) {
    $url = $GLOBALS['apiPhotos'] . "?Title=" . $title;
    $url = preg_replace("/ /", "%20", $url);
    $data = file_get_contents($url);
    return json_decode($data, true);
}

function regExpSearch($pattern, $list) {
    $matches = preg_match_all($pattern, $list);
    return $matches;
}

function getUser($code) {
    $data = file_get_contents($GLOBALS['apiPhotos'] . "?Email=" . $code);
    return json_decode($data, true);
}

?>