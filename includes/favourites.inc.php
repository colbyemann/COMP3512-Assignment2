<?php

function buildFavouritesPage()
{
    echo "
        <div class='box favs'>
            <h3>Your Favourited Images</h3>
                <div class='buffer'><input id='favs' type='button' value='Remove All'></div>";
                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<div class='buffer'><a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $f['ImageID'] . "'><img src='images/square150/" . $f['Path'] . "'><input id='favs' type='button' value='Remove from Favourites'></div></a>";
                }
        echo "
        </div>";
}

?>