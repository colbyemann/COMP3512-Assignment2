<?php 
    include("includes/header.inc.php");
    include("includes/validate.inc.php");
    include("includes/search.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
        <?php buildHead(); ?>
        <title>Browse/Search</title>
        <link rel="stylesheet" type="text/css" href="css/searchlayout.css">
        <link rel="stylesheet" type="text/css" href="css/popmenus.css">
    </head>
    <body>
        <?php
            //session_start();
            if(isset($_SESSION['logged_in'])) {
                buildMenu();
                buildLogoutMenu();
            }
            else {
                buildMenu();
                buildLoginMenu();
            }
        ?>
        <main class="container">
            <?php buildSearch(); 
        
                buildPopLogin();
                buildPopSignup();
                
            ?>
                <form method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                <button class="button" type="submit"> Filter </button>   
                    
                <?php
                populateCountryList();
                ?>
                    
                </form>
            <?php
            
            if($_SERVER["REQUEST_METHOD"] == "GET") {
               if (isset($_GET['ISO'])) {
                   outputCountryPhotos($_GET['ISO']);
                   
                   
               } 
               else
               {
                   outputPhotos();
               }
            }
    
            
               
                
    
                      
            ?>

        </main>
        <script src="js/pop.js"></script>
    </body>
</html>

<?php

function getPhotos ()
{
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php");
    $photos = json_decode($data, true);
    return $photos;
}

function getPhotosByCountry($iso)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php?ISO=" . $iso);
    $photos = json_decode($data, true);
    return $photos;
}


function getCountries()
{
    $data = file_get_contents("http://localhost/Assignment_2/api-countries.php");
    $countries = json_decode($data, true);
    return $countries;

} 

function populateCountryList()
{
    $countries = getCountries();
    $photos = getPhotos();

    
    echo "<select name=ISO>";
    echo "<option value='DEF'>Select a Country</option>";
    foreach($countries as $c)
    {
        $newCountry = true;
        
        foreach($photos as $p)
        {
            
            if($p['CountryCodeISO'] == $c['ISO'] && $newCountry == true)
            {
                
                echo "<option value='".$c['ISO']."'>". $c['CountryName'] ."</option>";
                $newCountry = false;
                
            }
            
            
           
        }

    }
    echo "</select>";
}

function outputCountryPhotos($iso)
{
    $photos = getPhotosByCountry($iso);
    foreach($photos as $p) {
        outputSinglePhoto($p);
    }
}

function outputPhotos()
{
    $photos = getPhotos();
    foreach($photos as $p) {
       outputSinglePhoto($p); 
    }
}



function outputSinglePhoto($photo)
{
   echo "<img src='images/square150/". $photo['Path'] . "'>";
   echo "<button type=button>View</button>";
   echo "<button type=button>Add to Favourites</button>";

}


?>