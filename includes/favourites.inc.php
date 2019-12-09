<?php

function buildFavouritesPage()
{
    $remove = true;
    echo "
        <div class='box favs'>
            <h3>Your Favourited Images</h3>
                <div class='buffer'><input id='favs' type='button' value='Remove All'></div>";
                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<div class='buffer'><a href='" . "?Path=" . $f['Path'] . "&amp;ImageID=" . $f['ImageID'] . "&amp;CountryCodeISO=" . 
                    $f['CountryCodeISO'] . "&amp;CityCode=" . $f['CityCode'] . "&amp;Remove=" . $remove . "'><img src='images/square150/" . $f['Path'] . "'>
                    <input id='favs' type='button' value='Remove from Favourites'></div></a>";
                }
                if(isset($_GET['Remove'])) {removeSessionElement($f['ImageID'], $f['Path'], $f['CountryCodeISO'], $f['CityCode']);}
        echo "
        </div>";
}

?>