<?php

$favouritesArray = array();
$GLOBALS['favouritesArray'];

function buildSearch()
{
    echo "<div class='box filter'>
        <h3>Photo Filter</h3>
    </div>

    <div class='box search'>
        <h3>Browse/Search</h3>
    </div>";
}

function populateCountryList() {
    $countries = getAllCountries();
    $photos = getAllPhotos();
    
    echo "<select name=ISO>";
    echo "<option value='DEF'>Select a Country</option>";
    foreach($countries as $c) {
        $newCountry = true;
        
        foreach($photos as $p) {
            
            if($p['CountryCodeISO'] == $c['ISO'] && $newCountry == true) {
                echo "<option value='".$c['ISO']."'>". $c['CountryName'] ."</option>";
                $newCountry = false;
            }
        }
    }
    echo "</select>";
}

function populateCityList($iso) {
    $cities = getCitiesByISO($iso);
    $photos = getAllPhotos();
    
    echo "<select name=CityCode>";
    echo "<option value='DEF'>Select a City</option>";
    
    foreach($cities as $c) {
        $newCity = true;
        
        foreach($photos as $p) {
            
            if($p['CityCode'] == $c['CityCode'] && $newCity == true) {
                
                echo "<option value='".$c['CityCode']."'>". $c['AsciiName'] . "</option>";
                $newCity = false;
            }
        }
    }
    echo "</select>";
}


function filterTitle($search)
{
    $photos = getAllPhotos();
    
    
    
    foreach($photos as $p)
    {
        
        echo "<h1>Working</h1>";
        
        if(strpos($p['Title'], $search) !== false)
        {
            echo "<h1>Hello</h1>";
            outputSearchPhotos($p['Title']);
        }
    }
}

function outputSearchPhotos($title)
{
    $photos = getPhotosByTitle($title);
    foreach($photos as $p) {
        outputSinglePhoto($p);
    }
}

function outputCountryPhotos($iso) {
    $photos = getPhotosByISO($iso);
    foreach($photos as $p) {
        outputSinglePhoto($p);
    }
}

function outputCityPhotos($code) {
    $photos = getPhotosByCityCode($code);
    foreach($photos as $p) {
        outputSinglePhoto($p);
    }
}

function outputPhotos() {
    $photos = getAllPhotos();
    foreach($photos as $p) {
       outputSinglePhoto($p); 
    }
}

function outputSinglePhoto($photo) {
    echo "<img src='images/square150/". $photo['Path'] . "'>";
    //echo "<p>" . $photo['Title'] . "</p>";
    echo "<a href='http://localhost/Assignment_2/single-photo.php?ImageID=". $photo['ImageID']  ."'><button type=button action=>View</button></img></a>";
    echo "<button type=button>Add to Favourites</button>";
}

?>