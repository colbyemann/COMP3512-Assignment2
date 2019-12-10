<?php

//global links APIs
$GLOBALS['apiCountries'] = "https://comp-3512-travel-app.herokuapp.com/api/api-countries.php";
$GLOBALS['apiCities'] = "https://comp-3512-travel-app.herokuapp.com/api/api-cities.php";
$GLOBALS['apiPhotos'] = "https://comp-3512-travel-app.herokuapp.com/api/api-photos.php";
//global links to "Single" Pages
$GLOBALS['singleCountryPage'] = "https://comp-3512-travel-app.herokuapp.com/single-country.php";
$GLOBALS['singlePhotoPage'] = "https://comp-3512-travel-app.herokuapp.com/single-photo.php";
$GLOBALS['singleCityPage'] = "https://comp-3512-travel-app.herokuapp.com/single-city.php";

//Retrieve all countries from API-Countries and format json into a usuable array.
function getAllCountries() {
    $data = file_get_contents($GLOBALS['apiCountries']);
    $countries = json_decode($data, true);
    return $countries;
}

//Retrieve all Countries by passed Country Code ISO from API-Countries and format json into a usuable array.
function getCountriesByISO($iso) {
    $data = file_get_contents($GLOBALS['apiCountries'] . "?ISO=" . $iso);
    return  json_decode($data, true);
}

//Retrieve all Cities by passed City Code ISO from API-Cities and format json into a usuable array.
function getCitiesByISO($iso) {
    $data = file_get_contents($GLOBALS['apiCities'] . "?ISO=" . $iso);
    return  json_decode($data, true);
}

//Retrieve specific by passed City Code from API-Cities and format json into a usuable array.
function getCitiesByCityCode($code) {
    $data = file_get_contents($GLOBALS['apiCities'] . "?CityCode=" . $code);
    return json_decode($data, true);
}

//Retrieve all photos from API-Photos and format json into a usuable array.
function getAllPhotos() {
    $data = file_get_contents($GLOBALS['apiPhotos']);
    return json_decode($data, true);
}

//Retrieve all photos by passed Photo ISO from API-Photos and format json into a usuable array.
function getPhotosByISO($iso) {
    $data = file_get_contents($GLOBALS['apiPhotos'] . "?ISO=" . $iso);
    return json_decode($data, true);
}

//Retrieve all photos by passed Photo City Code from API-Photos and format json into a usuable array.
function getPhotosByCityCode($code) {
    $data = file_get_contents($GLOBALS['apiPhotos'] . "?CityCode=" . $code);
    return json_decode($data, true);
}

//Retrieve specific photo by passed Photo Title from API-Photos and format json into a usuable array.
function getPhotosByTitle($title) {
    $url = $GLOBALS['apiPhotos'] . "?Title=" . $title;
    $url = preg_replace("/ /", "%20", $url);
    $data = file_get_contents($url);
    return json_decode($data, true);
}

//Retrieve user info by passed email from API-Photos and format json into a usuable array.
function getUser($code) {
    $data = file_get_contents($GLOBALS['apiPhotos'] . "?Email=" . $code);
    return json_decode($data, true);
}

?>