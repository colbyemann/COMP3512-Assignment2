<?php

function buildFavouritesPage()
{
    $remove = true;
    $removeAll = true;
    echo "
        <div class='box favs'>
            <h3>Your Favourited Images</h3>
                <div class='buffer'><a href='" . "?RemoveAll=" . $removeAll . "'><input id='favs' type='button' value='Remove All'></a></div>";

                if(isset($_GET['RemoveAll'])) {
                    $size = sizeof($_SESSION['favPhoto'], 0);
                    for($i = 0; $i <= $size; $i++) {
                        unset($_SESSION['favPhoto'][$i]);
                    }
                }

                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<div class='buffer'><img src='images/square150/" . $f['Path'] . "'><a href='" . "?Path=" . $f['Path'] . "&amp;ImageID=" . $f['ImageID'] . "&amp;CountryCodeISO=" . 
                    $f['CountryCodeISO'] . "&amp;CityCode=" . $f['CityCode'] . "&amp;Remove=" . $remove . "'><input id='favs' type='button' value='Remove from Favourites'></a></div>";
                }

                if(isset($_GET['Remove'])) {removeSessionElement($f['ImageID'], $f['Path'], $f['CountryCodeISO'], $f['CityCode']);}
        echo "
        </div>";
}

?>