<?php

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


function filterTitle($search) {
    $photos = getAllPhotos();
    foreach($photos as $p) {
        if(strpos(strtolower($p['Title']), strtolower($search)) !== false) {
            echo "<h1>Hello</h1>";
            outputSearchPhotos($p['Title']);
        }
    }
}

function outputSearchPhotos($title) {
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
    echo "<figure><img src='images/square150/". $photo['Path'] . "'>
    <figcaption>" . $photo['Title'] . "</figcaption></figure>
    <a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=" . $photo['ImageID'] . "'><button type=button action=>View</button></a>";
    showButton($photo);
}

function showButton($photo) {
    if(isset($_SESSION['logged_in'])) {
        if (searchArray($photo['ImageID'], $_SESSION['favPhoto'])) {
        }
        else {echo "<a href='" . "?Path=" . $photo['Path'] . "&amp;ImageID=" . $photo['ImageID'] . "'><button type=button action=>Add to Favourites</button></a>";}
    }
}

function pushSessionArray() {
    if (isset($_GET['ImageID'])) {
        $data = ['ImageID' => $_GET['ImageID'],'Path' => $_GET['Path']];
        array_push($_SESSION['favPhoto'], $data);
        echo "<script type='text/javascript'>alert('Photo added to Favourites');</script>";
    }
}

//https://wp-mix.com/php-search-multidimensional-array/
function searchArray($image, $array) {
	
	if (in_array($image, $array)) {
		return true;
	}
	
	foreach ($array as $a) {
		if (is_array($a) && array_search($image, $a)) 
		return true;
    }
    
	return false;
}

?>