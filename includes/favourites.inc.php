<?php

function buildFavouritesPage()
{
    $remove = true;
    $removeAll = true;
    echo "
        <div class='box favs'>
            <h3>Your Favourited Images</h3>
                <div class='buffer'><a href='" . "?RemoveAll=" . $removeAll . "'><input id='favs' type='button' value='Remove All'></div>";
                //if(isset($_GET['RemoveAll'])) {$_SESSION['favPhoto'] = null;}

                if($_SESSION['favPhoto'] == null) {}
                else {
                    foreach($_SESSION['favPhoto'] as $f) {
                        echo "<div class='buffer'><a href='" . "?Path=" . $f['Path'] . "&amp;ImageID=" . $f['ImageID'] . "&amp;CountryCodeISO=" . 
                        $f['CountryCodeISO'] . "&amp;CityCode=" . $f['CityCode'] . "&amp;Remove=" . $remove . "'><img src='images/square150/" . $f['Path'] . "'>
                        <input id='favs' type='button' value='Remove from Favourites'></div></a>";
                    }
                    if(isset($_GET['Remove'])) {removeSessionElement($f['ImageID'], $f['Path'], $f['CountryCodeISO'], $f['CityCode']);}
                }
                
        echo "
        </div>";
}

?>