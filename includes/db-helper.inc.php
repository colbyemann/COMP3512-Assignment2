<?php

//global links APIs
$GLOBALS['apiCountries'] = "https://comp-3512-travel-app.herokuapp.com/api/api-countries.php";
$GLOBALS['apiCities'] = "https://comp-3512-travel-app.herokuapp.com/api/api-cities.php";
$GLOBALS['apiPhotos'] = "https://comp-3512-travel-app.herokuapp.com/api/api-photos.php";
//global links to "Single" Pages
$GLOBALS['singleCountryPage'] = "https://comp-3512-travel-app.herokuapp.com/single-country.php";
$GLOBALS['singlePhotoPage'] = "https://comp-3512-travel-app.herokuapp.com/single-photo.php";
$GLOBALS['singleCityPage'] = "https://comp-3512-travel-app.herokuapp.com/single-city.php";

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