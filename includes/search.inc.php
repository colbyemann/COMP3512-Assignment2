<?php



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
    <a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=" . $photo['ImageID'] . "'><input id='favs' type='button' value='View'></a>";
    showButton($photo);
}

function showButton($photo) {
    if(isset($_SESSION['logged_in'])) {
        if (searchArray($photo['ImageID'], $_SESSION['favPhoto'])) {
            echo "<a href='" . "?Path=" . $photo['Path'] . "&amp;ImageID=" . $photo['ImageID'] . "&amp;ContinentCode=" . $photo['ContinentCode'] . "'>
            <input id='favs' type='button' value='Remove from Favourites'></a>";
        }
        else {echo "<a href='" . "?Path=" . $photo['Path'] . "&amp;ImageID=" . $photo['ImageID'] . "&amp;ActualCreator=" . $photo['ActualCreator'] . "'><input id='favs' type='button' value='Add to Favourites'></a>";}
        if(isset($_GET['ContinentCode'])) {removeSessionElement($_GET['ImageID'], $photo['Path']);}
    }
}

function addSessionElement() {
    $data = ['ImageID' => $_GET['ImageID'],'Path' => $_GET['Path']];
    array_push($_SESSION['favPhoto'], $data);
    echo "<script type='text/javascript'>alert('Photo added to Favourites');</script>";
}

function removeSessionElement($id, $path) {
    $data = ['ImageID' => $id, 'Path' => $path];
    $index = array_search($data, $_SESSION['favPhoto']);
    if($index !== false) {
        unset($_SESSION['favPhoto'][$index]);
        echo "<script type='text/javascript'>alert('Photo removed from Favourites');</script>";
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