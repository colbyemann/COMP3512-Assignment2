<?php

// Retrieves and displays any favourite photos set
function buildFavouritesPage()
{
    $remove = true;
    $removeAll = true;
    $index = 0;
    $size = sizeof($_SESSION['favPhoto'], 0);

    echo "
        <div class='box favs'>
            <h3>Your Favourited Images</h3>";
                // Checks if the Favourites array has any values
                if($size > 0) {
                    echo "<div class='buffer'><a href='" . "?RemoveAll=" . $removeAll . "'><input id='favs' type='button' value='Remove All'></a></div>";
                }
                else {
                    echo "<p>You haven't favourited any photos yet...</p>";
                }

                // Removes all values from the Favourites array
                if(isset($_GET['RemoveAll'])) {
                    for($i = 0; $i <= $size; $i++) {
                        unset($_SESSION['favPhoto'][$i]);
                    }
                }

                // Searches the Favourites array and displays the contents as images and a remove button
                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<div class='divider'><a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=" . $f['ImageID'] . "'><img src='images/square150/" . $f['Path'] . "'></a>
                    <a href='" . "?Path=" . $f['Path'] . "&amp;ImageID=" . $f['ImageID'] . "&amp;Index=" . $index . "&amp;Remove=" . $remove . "&amp;CountryCodeISO=" . 
                    $f['CountryCodeISO'] . "&amp;CityCode=" . $f['CityCode'] . "'><input id='favs' type='button' value='Remove from Favourites'></a></div>";
                    $index++;
                }

                if(isset($_GET['Remove'])) {
                    unset($_SESSION['favPhoto'][$_GET['Index']]);
                    echo "<script type='text/javascript'>alert('Photo removed from Favourites');</script>";
                }
        echo "
        </div>";
}

?>