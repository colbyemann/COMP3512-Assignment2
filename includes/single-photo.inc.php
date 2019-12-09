<?php

$photoArray = null;

function getArray() {
    $photos = getAllPhotos();
    $GLOBALS['photoArray'] = $photos;
}

function getImage($code) {
    foreach($GLOBALS['photoArray'] as $p) {
        if($p['ImageID'] == $code) {
        
        $url = "images/medium800/" . $p['Path'];
        echo "<div id='bigImage' style='background-image: url($url)'>";
        echo "<div id='texts'>";
        echo "<section>";
        echo $p['ActualCreator'] . "<br><br>";
        echo getExif($code);
        echo "</section>";
        echo "<br>";
        echo "<div id='colors2'>";
        echo "<section>";
        echo getColors($code);
        echo "</section>";
        echo "</div></div></div>";
     
        }
    }
}

function getInfo($code) {
    foreach($GLOBALS['photoArray'] as $p) {
        if($p['ImageID'] == $code) {
            echo "<h2 id=picTitle>" . $p['Title'] . "</h2>";
            echo "<p id=p1>" . $p['ActualCreator'] . "</p>" ;
            echo "<p id=p2>" . $p['Title'] . "</p>";
            getLocation($p['CountryCodeISO'], $p['CityCode']);
        }
    }
}

function getDesc($code) {
    foreach($GLOBALS['photoArray'] as $p) {
        if($p['ImageID'] == $code) {
            echo "<p>" . $p['Description'] . "</p>";
            
        }
    }
}

function getExif($code) {
    foreach($GLOBALS['photoArray'] as $p) {
        if($p['ImageID'] == $code) {
            $exif = json_decode($p['Exif'], true);
            
            echo "Aperture: " .  $exif['aperture'] . "<br>";
            echo "Exposure Time: " .  $exif['exposure_time'] . "<br>";
            echo "Focal Length: " .  $exif['focal_length'] . "<br>";
            echo "ISO: " .  $exif['iso'] . "<br>";
            echo "Make: " .  $exif['make'] . "<br>";
            echo "Model: " .  $exif['model'] . "<br>";
        }
    }
}

function getLocation($iso, $code) {
    $cities = getCitiesByCityCode($code);
    $country = getCountriesByISO($iso);

    foreach($country as $c) {
        if($c['ISO'] == $iso) {
        echo "<a href='" . $GLOBALS['singleCountryPage'] . "?ISO=" . $c['ISO']. "'><p>".  $c['CountryName'] . ", </a> " ;
        }
    }

    foreach($cities as $c) {
        if($c['CityCode'] == $code) {
        echo "<a href='" . $GLOBALS['singleCityPage'] . "?CityCode=". $c['CityCode']. "'>". $c['AsciiName'] . "</p></a>";
        }
    }
}

function getMap($code) {
    foreach($GLOBALS['photoArray'] as $p) {
        if($p['ImageID'] == $code) {
            $cities = getCitiesByCityCode($p['CityCode']);

            foreach($cities as $c) {
                if($c['CityCode'] == $p['CityCode']) {
                echo "<img width=100% height=300px src='https://maps.googleapis.com/maps/api/staticmap?center=" . $c['Latitude']. "," . $c['Longitude']. "&zoom=12&scale=1&size=500x300&maptype=roadmap&format=png&visual_refresh=true&key=AIzaSyDqyTT1dHib7v_0yGM8qaejN_ighZQ-UiY'>";
                }
            }
        }
    }
}

function getColors($code) {
    foreach($GLOBALS['photoArray'] as $p) {
        if($p['ImageID'] == $code) {
            $colors = json_decode($p['Colors'], true);
            foreach($colors as $color) {
               echo "<span style=background:$color;></span>";
            }
        }
    }
}

function getButton() {
    if(isset($_SESSION['logged_in'])) {
        $add = true;
        foreach($GLOBALS['photoArray'] as $p) {
            if($p['ImageID'] == $_GET['ImageID']) {
                $path = $p['Path'];
                $city = $p['CityCode'];
                $iso = $p['CountryCodeISO'];
                $title = $p['Title'];
            }
        }
        if (searchArray($_GET['ImageID'], $_SESSION['favPhoto'])) {}
        else {
            echo "<a href='" . "?Path=" . $path . "&amp;ImageID=" . $_GET['ImageID'] . "&amp;CountryCodeISO=" . $iso . 
            "&amp;CityCode=" . $city . "&amp;Title=" . $title . "&amp;Add=" . $add . "'>
            <input id='favs' type='button' value='Add to Favourites'></a>";
        }

        if(isset($_GET['Add'])) {addSessionElement();}
    }
}
?>