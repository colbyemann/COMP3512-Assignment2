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
    $noImage = true;
    $photos = getAllPhotos();
    
    foreach($photos as $p) {
        if(strpos(strtolower($p['Title']), strtolower($search)) !== false) {
            $noImage = false;
            outputSearchPhotos($p['Title']);
        }
        
    }
    
    if ($noImage == true)
        {
            echo "<h3>No images found.</h3>";
            $noImage = false;
        }
    
    if (empty($search))
    {
        echo "<h3>No images found.</h3>";
    }
}

function outputSearchPhotos($title) {
    $photos = getPhotosByTitle($title);
    
    if(is_array($photos)){
    foreach($photos as $p) {
        outputSinglePhoto($p);
    }      
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
    echo "<div id='divider'><figure><img src='images/square150/". $photo['Path'] . "'>
    <figcaption>" . $photo['Title'] . "</figcaption></figure>
    <a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=" . $photo['ImageID'] . "'><input id='favs' type='button' value='View'></a>";
    showButton($photo);
    echo "</div>";
}

function showButton($photo) {
    $add = true;
    $remove = true;
    if(isset($_SESSION['logged_in'])) {
        if (searchArray($photo['ImageID'], $_SESSION['favPhoto'])) {
            // echo "<a href='" . "?Path=" . $photo['Path'] . "&amp;ImageID=" . $photo['ImageID'] . "&amp;Remove=" . $remove . "&amp;CountryCodeISO=" . $photo['CountryCodeISO'] ."&amp;CityCode=" . $photo['CityCode'] ."'>
            // <input id='favs' type='button' value='Remove from Favourites'></a>";
        }
        else {echo "<a href='" . "?Path=" . $photo['Path'] . "&amp;ImageID=" . $photo['ImageID'] . "&amp;Add=" . $add . "&amp;CountryCodeISO=" . $photo['CountryCodeISO'] ."&amp;CityCode=" . $photo['CityCode'] . "'>
            <input id='favs' type='button' value='Add to Favourites'></a>";}
        if(isset($_GET['Remove'])) {removeSessionElement($_GET['ImageID'], $photo['Path'], $photo['CountryCodeISO'], $photo['CityCode']);}
    }
}

function addSessionElement() {
    $data = ['ImageID' => $_GET['ImageID'],'Path' => $_GET['Path'], 'CountryCodeISO' => $_GET['CountryCodeISO'], 'CityCode' => $_GET['CityCode']];
    array_push($_SESSION['favPhoto'], $data);
    echo "<script type='text/javascript'>alert('Photo added to Favourites');</script>";
}

function removeSessionElement($id, $path, $iso, $citycode) {
    $data = ['ImageID' => $id, 'Path' => $path, 'CountryCodeISO' => $iso, 'CityCode' => $citycode];
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