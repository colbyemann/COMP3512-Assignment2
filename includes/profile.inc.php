<?php

function buildProfilePage()
{
    echo "
        <div class='box userinfo'>
            <h3>User Info</h3>
        </div>

        <div class='box favs'>
            <h3>Favourited Images</h3>";
                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $f['ImageID'] . "'><img src='images/square150/" . $f['Path'] . "'></a>";
                }
        echo "
        </div>

        <div class='box search'>
            <input type=text id=text placeholder='Search Box for Photos'>
        </div>

        <div class='box like'>
            <h3>Images You May Like</h3>";
    
            $photos = getAllPhotos();
            $suggestedPhotos = 0;
            
            foreach($_SESSION['favPhoto'] as $f) {
                
                foreach($photos as $p)
                {
                    if($f['CountryCodeISO'] == $p['CountryCodeISO'] && $suggestedPhotos < 12 && $f['ImageID'] != $p['ImageID'])
                    {
                        echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $p['ImageID'] . "'><img src='images/square150/" . $p['Path'] . "'></a>";
                        
                        $suggestedPhotos = $suggestedPhotos + 1;
                        
                    }
                }
                    
                }
                    foreach($photos as $p) {
                        
                        if($suggestedPhotos < 12)
                        {
                            echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $p['ImageID'] . "'><img src='images/square150/" . $p['Path'] . "'></a>";
                        
                            $suggestedPhotos = $suggestedPhotos + 1;
                        }
                }
                
        
       echo "</div>";

}

?>
