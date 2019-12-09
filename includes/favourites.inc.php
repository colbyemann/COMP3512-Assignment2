<?php

function buildFavouritesPage()
{
    $remove = true;
    $removeAll = true;
    $size = sizeof($_SESSION['favPhoto'], 0);

    echo "
        <div class='box favs'>
            <h3>Your Favourited Images</h3>";
                if($size > 0) {
                    echo "<div class='buffer'><a href='" . "?RemoveAll=" . $removeAll . "'><input id='favs' type='button' value='Remove All'></a></div>";
                }
                else {
                    echo "<p>You haven't favourited any photos yet...</p>";
                }

                if(isset($_GET['RemoveAll'])) {
                    //$size = sizeof($_SESSION['favPhoto'], 0);
                    for($i = 0; $i <= $size; $i++) {
                        unset($_SESSION['favPhoto'][$i]);
                    }
                }

                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<div class='divider'><a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=" . $f['ImageID'] . "'><figure><img src='images/square150/" . $f['Path'] . "'>
                    <figcaption>" . $f['Title'] . "</figcaption></figure></a><a href='" . "?Path=" . $f['Path'] . "&amp;ImageID=" . $f['ImageID'] . "&amp;CountryCodeISO=" . 
                    $f['CountryCodeISO'] . "&amp;CityCode=" . $f['CityCode'] . "&amp;Remove=" . $remove . "'><input id='favs' type='button' value='Remove from Favourites'></a></div>";
                }

                if(isset($_GET['Remove'])) {removeSessionElement($f['ImageID'], $f['Path'], $f['CountryCodeISO'], $f['CityCode']);}
        echo "
        </div>";
}

?>