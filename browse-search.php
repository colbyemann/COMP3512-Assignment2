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
                   
            ?>
                <form method="get" action="<?=$_SERVER['REQUEST_URI']?>">
                <button class="button" type="submit"> Filter </button>   
            <?php
                   populateCityList($_GET['ISO']);
            ?>
                </form>
                    
            <?php     
                   
               } 
               else if (isset($_GET['CityCode']))
               {
                   outputCityPhotos($_GET['CityCode']);
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

function getPhotosByCity($code)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-photos.php?CityCode=" . $code);
    $photos = json_decode($data, true);
    return $photos;
}


function getCountries()
{
    $data = file_get_contents("http://localhost/Assignment_2/api-countries.php");
    $countries = json_decode($data, true);
    return $countries;

} 

function getCitiesByISO($iso)
{
    $data = file_get_contents("http://localhost/Assignment_2/api-cities.php?ISO=" . $iso);
    $cities = json_decode($data, true);
    return $cities;

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

function populateCityList($iso)
{
    $cities = getCitiesByISO($iso);
    $photos = getPhotos();

    
    echo "<select name=CityCode>";
    echo "<option value='DEF'>Select a City</option>";
    
    foreach($cities as $c)
    {
        $newCity = true;
        
        foreach($photos as $p)
        {
            
            if($p['CityCode'] == $c['CityCode'] && $newCity == true)
            {
                
                echo "<option value='".$c['CityCode']."'>". $c['AsciiName'] . "</option>";
                $newCity = false;
                
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

function outputCityPhotos($code)
{
    $photos = getPhotosByCity($code);
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
   //echo "<p>" . $photo['Title'] . "</p>";
    
    echo "<a href='http://localhost/Assignment_2/single-photo.php?ImageID=". $photo['ImageID']  ."'><button type=button action=>View</button></img></a>";

   
   echo "<button type=button>Add to Favourites</button>";

}


?>