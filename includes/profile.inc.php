<?php

function buildProfilePage()
{
    echo "
        <div class='box userinfo'>
        

            <h3>User Info</h3>";

           $user = getUser($_SESSION['sessionUser']);
           
            foreach($user as $u)
            {
               echo "<h4>Hello, " . $u['FirstName'] . " ". $u['LastName']. "</h4>";
               echo "<h4>" . $u['City'] . ", " . $u['Country'] . "</h4>";
               echo "<h4>" . $u['Email'] . "</h4>";
            }

     echo   "</div>


        <div class='box favs'>
            <h3>Favourited Images</h3>";
                foreach($_SESSION['favPhoto'] as $f) {
                    echo "<a href='" . $GLOBALS['singlePhotoPage'] . "?ImageID=". $f['ImageID'] . "'><img src='images/square150/" . $f['Path'] . "'></a>";
                }
        echo "
        </div>

        <form method='get' action='browse-search.php?'>  
        <div class='box search'>
            <input type=text id=text name=Title placeholder='Search Box for Photos'>
            <button class='button' type='submit'> Search Text </button>
        </div>
        </form>

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
